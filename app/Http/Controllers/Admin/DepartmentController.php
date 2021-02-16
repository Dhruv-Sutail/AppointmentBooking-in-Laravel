<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Department;
use Session;

class DepartmentController extends Controller
{
    public function Department()
    {
        $department = Department::all();
        return view('admin.Department.department')->with('department',$department);
    }

    public function  create()
    {
        return view('admin.Department.create');
    }

    public function store(Request $request)
    {
        $department= new Department();
        $department->department=$request->input('department');
        $department->sub_department=$request->input('sub_department');
        $department->max_appoint=$request->input('max_appoint');

        $department->save();
        Session::flash('statuscode','success');
        return redirect('/department-category')->with('status','Department Added');
    }

    public function edit($id)
    {
        $department = Department::find($id);
        return view('admin.Department.edit')->with('department',$department);
    }

    public function update(Request $request,$id)
    {
        $department = Department::find($id);
        $department->department= $request->input('department');
        $department->sub_department= $request->input('sub_department');
        $department->max_appoint= $request->input('max_appoint');

        $department->update();
        Session::flash('statuscode','success');
        return redirect('department-category')->with('status','Department Updated');
    }

    public function delete($id)
    {
        $department= Department::findorFail($id);
        $department->delete();

        return response()->json(['status'=>'Appointment Deleted']);
    }
}
