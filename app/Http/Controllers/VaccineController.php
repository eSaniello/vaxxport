<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vaccines;
use Illuminate\Http\Request;

class VaccineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $vaccines = Vaccines::where('approved', false)->orderBy('created_at', 'ASC')->paginate();
        return view('vaccines.index', compact('users', 'vaccines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vaccines.create');
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
            'name' => 'required',
            'date' => 'required',
        ]);

        Vaccines::create([
            'user_id' => auth()->user()->id,
            'name' => $request->name,
            'date' => $request->date,
            'approved' => false,
        ]);


        // redirect
        return redirect()->route('dashboard.index')->with('status', 'Vaccine inserted successfully');
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
        Vaccines::find($id)->update(['approved' => true]);

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
        Vaccines::find($id)->delete();

        return back()->with('status', 'Data deleted successfully');
    }
}
