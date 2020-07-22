<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Level;
use App\User;
use Hash;
use Auth;

class UserController extends Controller
{
    public function all_user()
    {
    	$user = User::all();
    	$level = Level::all();
    	return view('user.all',compact('level','user'));
    }
    public function add_user(Request $request)
    {
    	$messages = [
            'required' => ':attribute wajib diisi !!!',
            'unique' => 'attribut sama dengan database !!!',
            'numeric' => 'attribut harus diisi dengan angka !!!',
            'min' => ':attribute harus diisi minimal :min karakter!!!',
            'max' => ':attribute harus diisi maksimal :max karakter!!!',
        ];
    	$this->validate($request, [
            'username' => 'required|min:2',
            'name' => 'required|min:2',
            'address' => 'required|min:3',
            'level_id' => 'required',
            'password' => 'required|min:6',
            'passwordconf' => 'required|same:password'
        ], $messages);
        $user_id = Auth::user()->id;
        $user = new User();
        $user->username = $request->username;
        $user->name = $request->name;
        $user->address = $request->address;
        $user->level_id = $request->level_id;
        $user->password = Hash::make($request->password);
        $result = $user->save();
        \LogActivity::addToLog([
            'data' => 'Menambahkan User ' . $request->name,
            'user' => $user_id,
        ]);
        if ($result) {
            alert()->success('User Successfully Add', 'Success');
            return back();
        } else {
            alert()->error('User Gagal Ditambahkan', 'Berhasil');
            return back();
        }
    }

    public function delete_user($id)
    {
        $user_id = Auth::user()->id;
    	$user = User::find($id);
        \LogActivity::addToLog([
            'data' => 'Menghapus User ' . $user->name,
            'user' => $user_id,
        ]);
        $user->delete();
        alert()->success('User Successfully Deleted', 'Berhasil');
        return back();
    }

    public function edit_user($id)
    {
    	$level = Level::all();
    	$user = User::find($id);
    	return view('user.edit',compact('user','level'));
    }
     public function update_user(Request $request, $id)
    {$messages = [
            'required' => ':attribute wajib diisi !!!',
            'unique' => 'attribut sama dengan database !!!',
            'numeric' => 'attribut harus diisi dengan angka !!!',
            'min' => ':attribute harus diisi minimal :min karakter!!!',
            'max' => ':attribute harus diisi maksimal :max karakter!!!',
        ];
    	$this->validate($request, [
            'username' => 'required|min:2',
            'name' => 'required|min:2',
            'address' => 'required|min:3',
            'level_id' => 'required',
            'password' => '',
            'confPassword' => 'same:password'
        ], $messages);
        $user_id = Auth()->user()->id;
        $user = User::find($id);
        $user->name = $request->get('name');
        $user->username = $request->get('username');
        $user->address = $request->get('address');
        $user->username = $request->get('username');
        $user->level_id = $request->get('level_id');
        if ($request->get('password') != '') {
            $user->password = Hash::make($request->get('password'));
        }

        $aks = $user->save();
         \LogActivity::addToLog([
            'data' => 'Mengupdate User ' . $user->name,
            'user' => $user_id,
        ]);
        if ($aks) {
            alert()->success('User Successfully Updated', 'Success');
            return redirect('/user/all');
        } else {
            return back();
        }
    }
}
