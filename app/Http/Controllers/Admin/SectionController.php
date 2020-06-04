<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Section;

class SectionController extends Controller
{
    function index() {
        $sections = Section::all();
        return view('admin.sections')->with(compact('sections'));
    }

    function updateSectionStatus(Request $request) {
        if($request->ajax()) {
            $data = $request->all();
            if($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }

            Section::where('id', $data['section_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'section_id' => $data['section_id']]);
        }
    }
}
