<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        // $departments = Department::all();
        $deptObj = Department::latest();
        if($request->has('search') && !empty($request->get('search'))){
        $search = $request->input('search');
        $deptObj->whereRaw("(name ILIKE E'%" . $search . "%')");
            $departments = $deptObj->paginate(10)->appends(['q' => $search]);
        } else {
            $departments = $deptObj->paginate(10);
        }   
        return view('departments.index', compact('departments'));
    }
    public function add()
    {
        return view('departments.add');
    }
    public function store(Request $request)
    {
        $validate  = $request->validate([
            'name' => 'required|max:255',
        ]);
        $deparment = new Department;
        $deparment->name = $request->name;
        $deparment->save();
        return redirect('/departments')->with('success', 'New Record Added Successfully.');
    }

    public function show($id)
    {
        $departments = Department::find($id);
        return view('departments.show',compact('departments'));
    }

    public function edit($id)
    {
        $departments = Department::findOrFail($id);
        return view('departments.edit', compact('departments'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);
        $requestData = $request->all();
        $departmentObj = Department::find($id);
            $departmentObj->name        = $requestData['name'] ?? $departmentObj->name;
            $departmentObj->save();
        
        return redirect('/departments')->with('success', 'Record Updated Successfully.');
    }
    public function destroy($id)
    {
        $depObj = Department::findOrFail($id);
        $depObj->delete();
        return redirect('/departments')->with('success', 'Record Deleted Successfully.');
    }

}
