<?php

namespace App\Http\Controllers;

use App\Models\Infections;
use App\Models\User;
use App\Models\Vaccines;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
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
            'firstname' => 'required',
            'lastname' => 'required',
            'e_id_number' => 'required',
            'mobile' => 'required',
            'address' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'repeat_password' => 'required|min:6',
        ]);

        if ($request->password != $request->repeat_password) {
            return back()->with('status', 'Passwords must match!');
        } else if (User::where('email', $request->email)->count() > 0) {
            return back()->with('status', 'User already exists!');
        } else {
            User::create([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'e_id_number' => $request->e_id_number,
                'mobile' => $request->mobile,
                'address' => $request->address,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'type' => 'user',
            ]);
        }

        // redirect
        return redirect()->route('login')->with('status', 'User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $infections = Infections::where('user_id', auth()->user()->id)->paginate(30);
        $vaccines = Vaccines::where('user_id', auth()->user()->id)->paginate(30);
        return view('users.show', compact('user', 'infections', 'vaccines'));
    }

    public function make_admin($id)
    {
        $user = User::find($id);

        if ($user->type == 'admin')
            $user->update(['type' => 'user']);
        else if ($user->type == 'user')
            $user->update(['type' => 'admin']);

        return back();
    }

    public function qr_code($id)
    {
        $user = User::find($id);
        $infections = Infections::where('user_id', $user->id)->get();
        $vaccines = Vaccines::where('user_id', $user->id)->get();

        $status = 'none';
        $approved_vax = 0;
        $approved_inf = 0;

        foreach ($vaccines as $vax) {
            if ($vax->approved == true) {
                $approved_vax++;
            }
        }
        foreach ($infections as $inf) {
            if ($inf->approved == true) {
                $approved_inf++;
            }
        }

        if ($approved_vax >= 2)
            $status = 'full_vax';
        else if ($approved_vax == 1)
            $status = 'part_vax';
        else if ($approved_vax == 0)
            $status = 'none';

        return view('users.qr_code', compact('user', 'infections', 'vaccines', 'status'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));
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
        $user = User::find($id);

        // validation
        $this->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'e_id_number' => 'required',
            'mobile' => 'required',
            'address' => 'required',
            'email' => 'required|email',
        ]);

        if ($request->password != null) {
            if ($request->password != $request->repeat_password) {
                return back()->with('status', 'Passwords must match!');
            }
        }

        if (User::where('email', $request->email)->count() > 0 && User::where('email', $request->email)->get()[0]->email != $user->email) {
            return back()->with('status', 'User already exists!');
        } else {
            $user->update([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'e_id_number' => $request->e_id_number,
                'mobile' => $request->mobile,
                'address' => $request->address,
                'email' => $request->email,
                'password' => $request->password != null ? Hash::make($request->password) : $user->password,
            ]);
        }

        // redirect
        return redirect()->route('user.index')->with('status', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('user.index');
    }
}
