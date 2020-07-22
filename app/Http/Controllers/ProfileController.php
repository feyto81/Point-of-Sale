<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Level;
use Hash;
use Auth;
use DB;
use App\User;

class ProfileController extends Controller
{
    public function index()
    {
    	$level = Level::all();
        $user_id = Auth::user()->id;
        $profile = User::where('id', $user_id)
            ->limit(1)->get();
        return view('profile.index', compact('profile', 'level', 'settingall'));
    }
     public function updatepassword(Request $request)
    {

        $this->validate($request, [
            'oldPassword' => 'required|min:2|max:35',
            'newPassword' => 'required|min:7',
            'confPassword' => 'required|min:7|same:newPassword'

        ]);
        $user_id = Auth::user()->id;
        $oldPassword = $request->oldPassword;
        $newPassword = $request->newPassword;
        $user_id = Auth::user()->id;

        if (!Hash::check($oldPassword, Auth::user()->password)) {
            alert()->error('The specified password does not match to database password', 'Error');
            return back();
        } else {
            $request->user()->fill(['password' => Hash::make($newPassword)])->save();
        \LogActivity::addToLog([
            'data' => 'Mengupdate Password ' . $user_id,
            'user' => $user_id,
        ]);
        alert()->success('Password has been updated', 'Success');
        return back()->with('msg', '');
        }
    }
    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:2|max:35',
            'username' => 'required',
            'address' => 'required',

        ]);
        $user_id = Auth::user()->id;
        DB::table('users')->where('id', $user_id)->update($request->except('_token', 'password', 'level_id','email'));
        \LogActivity::addToLog([
            'data' => 'Mengupdate Profile ' . $user_id,
            'user' => $user_id,
        ]);
        alert()->success('Profile Successfully Updated', 'Success');
        return back();
    }
}
