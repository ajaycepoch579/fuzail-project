<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\StudentImage;
use Illuminate\Support\Facades\Storage;

class StudentWebController extends Controller
{
    public function index()
    {
        // $student = Student::all();
        $student = Student::paginate(10);
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
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $student = new Student;
        $student->name = $request->name;
        $student->class = $request->class;
        $student->roll_number = $request->roll_number;
        $student->save();
            if($student->save())
            {
                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    // $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
                    $filename = time().'.'.request()->image->getClientOriginalExtension();
                    request()->image->move(public_path('images'), $filename);
                        // $request->image->storeAs('images', $filename);
                        $stuImg = new StudentImage();
                        $stuImg->stu_id = $student->id;
                        $stuImg->image=$filename;
                        $stuImg->save();
                }
            }
        
        return redirect('/students')->with('success', 'New Student is Added.');
    }
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('students.edit', compact('student'));
    }

    public function show($id)
    {
        $students = Student::find($id);
        $image = StudentImage::where('stu_id',$id)->latest()->first();
        // dd($img->image);

        // echo "<img src="/storage/images/$image-" />";
        return view('students.show',compact('students','image'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'class' => 'required|max:255',
            'roll_number' => 'required',
        ]);
        $requestData = $request->all();
    
            $studentObj = Student::find($id);
            $studentObj->name        = $requestData['name'] ?? $studentObj->name;
            $studentObj->class       = $requestData['class'] ?? $studentObj->class;
            $studentObj->roll_number = $requestData['roll_number'] ?? $studentObj->roll_number;
            $studentObj->save();
                if($studentObj->save())
                {
                    if ($request->hasFile('image')) 
                    {
                        $image = $request->file('image');
                        // $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
                        $filename = time().'.'.request()->image->getClientOriginalExtension();
                        request()->image->move(public_path('images'), $filename);
                            // $request->image->storeAs('images', $filename);
                            $stuImg = new StudentImage();
                            $stuImg->stu_id = $id;
                            $stuImg->image=$filename;
                            $stuImg->save();
                    }
                }
            // $studentObj->employee_no = $requestData['employee_no'] ?? $filterObj->employee_no;
        // $student = Student::whereId($id)->update($validate);
        return redirect('/students')->with('success', 'Student has been updated');
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return redirect('/students')->with('success', 'Student has been deleted');
    }
    public function addImage($id)
    {
        $students = $id;
        return view('students.addimage',compact('students'));
    }
    public function saveImage(Request $request , $id)
    {
        $request->validate([
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'image' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);  
        // $allowedfileExtension=['pdf','jpg','png'];
        
        if ($request->hasFile('image')) {
            $images = $request->file('image');       
            foreach($images as $image){
                // dd($image);
            $filename = $image->getClientOriginalName();
            // $extension = $image->getClientOriginalExtension();
            // dd($extension);
            $image->move(public_path('images'), $filename);
                // $request->image->storeAs('images', $filename);
                $stuImg = new StudentImage();
                $stuImg->stu_id = $id;
                $stuImg->image=$filename;
                $stuImg->save();
            }
        }
        return redirect('/students')->with('success', 'Images Added Successfully.');
    }
}
