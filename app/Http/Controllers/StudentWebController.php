<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentWebController extends Controller
{
    public function index()
    {
        $student = Student::all();
        return view('students.index', compact('student'));
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
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('students.edit', compact('student'));
    }

    public function show($id)
    {
        $students = Student::find($id);
        return view('students.show',compact('students'));
    }

    public function update(Request $request, $id)
    {
        $validate  = $request->validate([
            'name' => 'required|max:255',
            'class' => 'required|max:255',
            'roll_number' => 'required',
        ]);
        Student::whereId($id)->update($validate);
        return redirect('/students')->with('completed', 'Student has been updated');
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return redirect('/students')->with('completed', 'Student has been deleted');
    }
}
