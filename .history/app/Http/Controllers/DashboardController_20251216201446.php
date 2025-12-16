<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\User;
use App\Models\Attachment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $manager = auth()->user();
        
        // Count modules for this manager
        $modulesCount = Module::where('manager_id', $manager->id)->count();
        
        // Count students for this manager
        $studentsCount = User::where('role', 'student')
            ->where('manager_id', $manager->id)
            ->count();
        
        // Count attachments for modules belonging to this manager
        $attachmentsCount = Attachment::whereHas('module', function($query) use ($manager) {
            $query->where('manager_id', $manager->id);
        })->count();

        // Get recent modules for this manager
        $recentModules = Module::where('manager_id', $manager->id)
            ->latest()
            ->limit(5)
            ->get();
        
        // Get recent students for this manager
        $recentStudents = User::where('role', 'student')
            ->where('manager_id', $manager->id)
            ->latest()
            ->limit(5)
            ->get();

        return view('manager.dashboard', compact('modulesCount', 'studentsCount', 'attachmentsCount', 'recentModules', 'recentStudents'));
    }
}
