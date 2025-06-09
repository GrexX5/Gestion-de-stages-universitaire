<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Student;

class TeacherStudentsController extends Controller
{
    public function index()
    {
        $teacherId = Auth::id();
        $students = Student::where('teacher_id', $teacherId)->with(['user', 'offers.company'])->paginate(10);
        return view('teacher.students', compact('students'));
    }
}
