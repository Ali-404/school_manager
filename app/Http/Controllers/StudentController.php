<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    /**
     * Show the list of all students (for manager dashboard)
     */
    public function index()
    {
        $manager = auth()->user();
        $students = User::where('role', 'student')
            ->where('manager_id', $manager->id)
            ->get();
        return view('manager.students', ['students' => $students]);
    }

    /**
     * Store a newly created student in storage
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'age' => ['required', 'integer', 'min:5', 'max:100'],
            'gender' => ['required', 'in:male,female,other'],
        ]);

        // Generate a random password for the student
        $password = "student123";

        $manager = auth()->user();
        $student = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($password),
            'role' => 'student',
            'manager_id' => $manager->id,
        ]);

        // Store the plain password temporarily in session for display
        session()->flash('student_created', [
            'name' => $student->name,
            'email' => $student->email,
            'password' => $password,
            'student_id' => $student->id,
        ]);

        return back()->with('success', 'Student created successfully! See credentials below.');
    }

    /**
     * Update the specified student in storage
     */
    public function update(Request $request, User $student)
    {
        $manager = auth()->user();
        // Ensure this is a student and belongs to the current manager
        if ($student->role !== 'student' || $student->manager_id !== $manager->id) {
            return back()->with('error', 'Invalid student.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,' . $student->id],
            'age' => ['sometimes', 'integer', 'min:5', 'max:100'],
            'gender' => ['sometimes', 'in:male,female,other'],
            'password' => ['sometimes', 'nullable', 'min:6'],
        ]);

        // If password provided, hash it before updating
        if (!empty($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        $student->update($validated);

        return back()->with('success', 'Student updated successfully!');
    }

    /**
     * Delete the specified student from storage
     */
    public function destroy(User $student)
    {
        $manager = auth()->user();
        // Ensure this is a student and belongs to the current manager
        if ($student->role !== 'student' || $student->manager_id !== $manager->id) {
            return back()->with('error', 'Invalid student.');
        }

        $name = $student->name;
        $student->delete();

        return back()->with('success', "Student '{$name}' deleted successfully!");
    }
}
