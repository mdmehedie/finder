<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::where('role', '=', 'user')->get();
        return view('admin-dashboard', compact('users'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('user_edit', compact('user'));
    }


    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validation = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $request->id,
            'activationDate' => 'date',
            'isActive'=>'nullable'
        ]);

        if ($validation->fails()) {
            return back()->withInput()->with('error', $validation->errors());
        }


        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->activationDate = $request->input('activationDate');
        $user->isActive = $request->has('isActive'); // Set isActive based on the request
        $user->save();

        return redirect()->route('dashboard')->with('success', 'User updated successfully!');

    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('dashboard')->with('success', 'User deleted successfully!');
    }
}
