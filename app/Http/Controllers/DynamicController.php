<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DynamicController extends Controller
{
    public function index()
    {
       $department=DB::table('departments')->groupBy('department')->get();
       return view('dynamic')->with('department',$department);
    }
     public function fetch(Request $request)
    {
        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');
        $data = DB::table('departments')
            ->where($select, $value)
            ->groupBy($dependent)
            ->get();
        $output = '<option value="">Select '.ucfirst($dependent).'</option>';
        foreach($data as $row)
        {
            $output .= '<option value="'.$row->$dependent.'">'.$row->$dependent.'</option>';
        }
        echo $output;
    }

}
