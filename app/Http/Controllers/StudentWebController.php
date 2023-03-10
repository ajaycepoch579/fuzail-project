<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\StudentImage;
use App\Models\Department;
use Illuminate\Support\Facades\Storage;

class StudentWebController extends Controller
{
    public function index(Request $request)
    {
        // $department = Department::all();
        $studentObj = Student::latest();
        if($request->has('search') && !empty($request->get('search'))){
        $search = $request->input('search');
        $studentObj->whereRaw("(name ILIKE E'%" . $search . "%'  OR class ILIKE E'%" . $search . "%' OR roll_number ILIKE E'%" . $search . "%')");
            $studentObj->orWhereHas('department', function ($query) use ($search){
                $query->where('name', 'like', '%'.$search.'%');
            });
            $student = $studentObj->paginate(10)->appends(['q' => $search]);
        } else {
            $student = $studentObj->paginate(10);
        }       
        return view('students.index', compact('student'));
    }
    public function add()
    {
        $department = Department::all();
        return view('students.add',compact('department'));
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
        $student->department_id = $request->department;
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
        $department = Department::all();
        return view('students.edit', compact('student','department'));
    }

    public function show($id)
    {
        $students = Student::find($id);
        return view('students.show',compact('students'));
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
            $studentObj->department_id =  $requestData['department'] ?? $request->department;
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
            'image' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);  
        if ($request->hasFile('image')) {
            $images = $request->file('image');       
            foreach($images as $image){
            $filename = $image->getClientOriginalName();
            $image->move(public_path('images'), $filename);
                $stuImg = new StudentImage();
                $stuImg->stu_id = $id;
                $stuImg->image=$filename;
                $stuImg->save();
            }
        }
        return redirect('/students')->with('success', 'Images Added Successfully.');
    }

    public function search(Request $request){
        // Get the search value from the request
        $search = $request->input('search');
    
        // Search in the title and body columns from the posts table
        $student = Student::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->orWhere('class', 'LIKE', "%{$search}%")
            ->orWhere('roll_number', 'LIKE', "%{$search}%")
            ->get();
    
        // Return the search view with the resluts compacted
        return view('students.index', compact('student'));
    }
}
