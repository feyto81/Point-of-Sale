<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unit;
use Auth;

class UnitController extends Controller
{
    public function all_unit()
    {
    	$unit = Unit::all();
    	return view('product.unit.all',compact('unit'));
    }
    public function add_unit()
    {
    	return view('product.unit.add');
    }
    public function save_unit(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:2|unique:units',
        ]);
        $user_id = Auth::user()->id;
        $unit = new Unit;
        $unit->fill($request->all());
        \LogActivity::addToLog([
            'data' => 'Menambahkan Unit ' . $request->name,
            'user' => $user_id,
        ]);
        $result = $unit->save();
        if ($result) {
            alert()->success('Unit Successfully Added', 'Success');
            return redirect('/unitall');
        } else {
            alert()->error('Unit Failed Added', 'Success');
            return back();
        }
    }
    public function edit_unit($unit_id)
    {
        $unit = Unit::findOrFail($unit_id);
        return view('product.unit.edit', compact('unit'));
    }
    public function update_unit(Request $request, $unit_id)
    {
        $this->validate($request, [
            'name' => 'required|min:2',
        ]);
        $user_id = Auth::user()->id;
        $unit = Unit::find($unit_id);
        $unit->fill($request->all());
        \LogActivity::addToLog([
            'data' => 'Mengupdate Unit ' . $request->name,
            'user' => $user_id,
        ]);
        $unit->update();
        alert()->success('Unit Successfully Updated', 'Success');
        return redirect('/unitall');
    }

    public function delete_unit($unit_id)
    {
        $user_id = Auth::user()->id;
        $unit = Unit::find($unit_id);
        \LogActivity::addToLog([
            'data' => 'Menghapus Unit ' . $unit->name,
            'user' => $user_id,
        ]);
        $unit->delete();
        alert()->success('Unit Successfully Deleted', 'Success');
        return back();
    }
}
