<?php

namespace App\Http\Controllers;

use App\Models\Infections;
use App\Models\User;
use Illuminate\Http\Request;

class InfectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $infections = Infections::where('approved', false)->orderBy('created_at', 'ASC')->paginate(30);
        return view('infections.index', compact('users', 'infections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('infections.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validation
        $this->validate($request, [
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        Infections::create([
            'user_id' => auth()->user()->id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'approved' => false,
        ]);


        // redirect
        return redirect()->route('dashboard.index')->with('status', 'COVID infection inserted successfully');
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
        Infections::find($id)->update(['approved' => true]);

        return back()->with('status', 'Approved successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Infections::find($id)->delete();

        return back()->with('status', 'Data deleted successfully');
    }
}
