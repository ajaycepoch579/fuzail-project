<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    public function store()
    {
        $validate  = $request->validate([
            'name' => 'required|max:255',
            'class' => 'required|max:255',
            'roll_number' => 'required',
        ]);
        $student = new Student;
        $student->name = 
    }
}
