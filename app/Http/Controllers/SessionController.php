<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Sessions;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        // return "ahde";
        $module = "Session Master";
        $session_data = Sessions::all();
        $from_date = date('d-m-Y');
        $to_date = date('d-m-Y');
        $btnName = "Save";
        return view('admin/master/session_master', compact('from_date', 'to_date', 'session_data', 'btnName', "module"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'from_date' => 'required',
            'to_date' => 'required',
            'session_name' => 'required',
        ]);
        if (isset($request->session_id)) {
            $id = $request->session_id;
            $data = Sessions::find($id);
            $data->session_name = $request->session_name;
            $data->from_date = date('Y-m-d', strtotime($request->from_date));
            $data->to_date = date('Y-m-d', strtotime($request->to_date));
            $data->update();
            return redirect('admin/master/Sessions')->with('update', 'Data Update Successfully!!');
        }
        $from_date = date('Y-m-d', strtotime($request->from_date));
        $to_date = date('Y-m-d', strtotime($request->to_date));
        $session =  new Sessions;
        $session->session_name = $request->session_name;
        $session->from_date = $from_date;
        $session->to_date = $to_date;
        $session->status = 1;
        $session->ipaddress = $request->ip();
        $session->save();
        return redirect('admin/master/Sessions')->with('update', 'Data Update Successfully!!');
    }

    public function edit($id)
    {

        $editData = sessions::find($id);
        // return $editData;
        $session_data = sessions::all();
        $to_date = date('d-m-Y', strtotime($editData->to_date));
        $from_date = date('d-m-Y', strtotime($editData->from_date));
        $btnName = "Update";
        return view('admin/master/session_master', compact('from_date', 'to_date', 'session_data', 'btnName', 'editData'));
    }

    // public function update(Request $request, $id)
    // {
    // }


    public function destroy($id)
    {
        $session = Sessions::find($id);
        $session->delete();
        return redirect('admin/master/Sessions')->with('error', 'Data Delete Successfully!!');
    }
    public function change_status(Request $request)
    {
        if ($request->status != "") {
            // return Sessions::query();
            Sessions::query()->update(['status' => 0]);
            $session = Sessions::find($request->id);
            $session->status = 1;
            $session->update();
            return 1;
        }
    }
}
