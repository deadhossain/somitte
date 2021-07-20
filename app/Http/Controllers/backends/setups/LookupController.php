<?php

namespace App\Http\Controllers\backends\setups;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\setups\Lookup;
use Yajra\DataTables\Facades\DataTables;

use App\Http\Requests\backends\setups\StoreLookupRequest;

class LookupController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lookups = Lookup::all();
        return view('backends.pages.setups.lookup.index',compact('lookups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backends.pages.setups.lookup.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLookupRequest $request)
    {
        try {
            $lookup = new Lookup;
            $lookup->name = $request->input('name');
            $lookup->remarks = $request->input('remarks');
            $lookup->active_fg = 1;
            // $lookup->created_by = session('user')->id;
            $is_saved = $lookup->save();
            if ($is_saved) {
                return back()->with('message', 'Lookup has been added');
            } else {
                return back()->withErrors(['error'=>'Lookup has not been added']);
            }
        } catch (\Exception $th) {
            return back()->withErrors([
                'error'=>'Seek system administrator help',
                'error-dev'=> $th->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lookup = Lookup::findorFail($id);
        return view('backends.pages.setups.lookup.edit',compact('lookup','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreLookupRequest $request, $id)
    {
        try {
            $rules = [ 'name' => 'required|unique:lookup,name,'.$id ];
            $customAttributes = [ 'name' =>'Name' ];
            $message = array();
            $validator = Validator::make($request->all(),$rules,$message,$customAttributes);
            if ($validator->fails()) return response()->json(['error'=>$validator->errors()]);

            $lookup = Lookup::findorFail($id);
            $lookup->name = $request->input('name');
            $lookup->remarks = $request->input('remarks');
            $lookup->active_fg = $request->input('status');
            $lookup->updated_by = session('user')->id;
            $result = $lookup->save();
            if ($result) return response()->json(['success'=>$lookup->name.' is saved']);
            return response()->json(['error'=>'Fail to save '.$lookup->name]);
        } catch (Exception $e) {
            return response()->json([
                'success' => 'false',
                'errors'  => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
