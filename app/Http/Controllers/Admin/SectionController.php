<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Section;
use Illuminate\Support\Facades\Session;

class SectionController extends Controller
{
    function index() {
        $sections = Section::all();
        Session::put('page', 'sections');
        return view('admin.sections')->with(compact('sections'));
    }

    function updateSectionStatus(Request $request) {
        if($request->ajax()) {
            $data = $request->all();
            if($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }

            Section::where('id', $data['record_id'])->update(['status' => $status]);
            return response()->json(['status' => $status]);
        }
    }
}
