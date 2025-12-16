<?php
namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AttachmentController extends Controller
{
    // Manager: list attachments of a module
    public function index(Module $module)
    {
        $manager = auth()->user();
        // Ensure the module belongs to the current manager
        if ($module->manager_id !== $manager->id) {
            abort(403, 'Unauthorized');
        }

        $attachments = $module->attachments()->latest()->paginate(12);

        return view('manager.attachments', compact('module', 'attachments'));
    }

    // Student: list attachments of a module
    public function studentIndex(Module $module)
    {
        $student = auth()->user();
        // Ensure the module belongs to the student's manager
        if ($module->manager_id !== $student->manager_id) {
            abort(403, 'Unauthorized');
        }

        $attachments = $module->attachments()->latest()->paginate(12);

        return view('student.attachments', compact('module', 'attachments'));
    }

    // Store attachment FOR a module
    public function store(Request $request, Module $module)
    {
        $manager = auth()->user();
        // Ensure the module belongs to the current manager
        if ($module->manager_id !== $manager->id) {
            abort(403, 'Unauthorized');
        }

        $data = $request->validate([
            'title' => 'required|string|max:191',
            'description' => 'nullable|string',
            'file' => 'required|file|max:51200', // 50MB
        ]);

        $file = $request->file('file');
        $filename = Str::random(12) . '_' . time() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('attachments', $filename, 'public');

        $module->attachments()->create([
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'file_path' => $path,
            'uploaded_by' => $request->user()->id,
        ]);

        return redirect()
            ->route('manager.modules.attachments.index', $module)
            ->with('success', 'Attachment uploaded.');
    }

    // Delete attachment (safe check)
    public function destroy(Module $module, Attachment $attachment)
    {
        $manager = auth()->user();
        // Ensure the module belongs to the current manager
        if ($module->manager_id !== $manager->id) {
            abort(403, 'Unauthorized');
        }

        if ($attachment->module_id !== $module->id) {
            abort(404);
        }

        if (Storage::disk('public')->exists($attachment->file_path)) {
            Storage::disk('public')->delete($attachment->file_path);
        }

        $attachment->delete();

        return back()->with('success', 'Attachment deleted.');
    }

    // Download attachment
    public function download(Module $module, Attachment $attachment)
    {
        $user = auth()->user();
        
        // For managers: ensure module belongs to them
        // For students: ensure module belongs to their manager
        if ($user->role === 'manager') {
            if ($module->manager_id !== $user->id) {
                abort(403, 'Unauthorized');
            }
        } else if ($user->role === 'student') {
            if ($module->manager_id !== $user->manager_id) {
                abort(403, 'Unauthorized');
            }
        }

        if ($attachment->module_id !== $module->id) {
            abort(404);
        }

        if (!Storage::disk('public')->exists($attachment->file_path)) {
            abort(404);
        }

        return Storage::disk('public')->download(
            $attachment->file_path,
            $attachment->title . '.' . pathinfo($attachment->file_path, PATHINFO_EXTENSION)
        );
    }
}
