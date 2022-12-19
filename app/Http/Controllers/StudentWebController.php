<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentWebController extends Controller
{
    public function index()
    {
        // dd("index");

        return view('students.index');
    }
    public function add()
    {
        // dd("add student");
        return view('students.add');
    }
    public function store(Request $request)
    {
        $validate  = $request->validate([
            'name' => 'required|max:255',
            'class' => 'required|max:255',
            'roll_number' => 'required',
        ]);
        $student = new Student;
        $student->name = $request->name;
        $student->class = $request->class;
        $student->roll_number = $request->roll_number;
        $student->save();
        return redirect('/students')->with('completed', 'Student has been saved!');
    }
}
