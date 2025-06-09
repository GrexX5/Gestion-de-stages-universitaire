<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Convention;

class TeacherConventionsController extends Controller
{
    public function index()
    {
        $teacherId = Auth::id();
        $conventions = Convention::where('teacher_id', $teacherId)->with(['student.user', 'company'])->latest()->paginate(10);
        return view('teacher.conventions', compact('conventions'));
    }
}
