<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class AdminDataController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->isMethod('get')) {
            //READ
            $title = 'Admins';
            $data_admins = Admin::all();
            return view('admin.admin', compact('title' , 'data_admins'));
        } elseif ($request->isMethod('patch')) {
            $data_admin = Admin::where('id', $request->AdminIDEdit)->first();
            $image = $request->file('AdminImageEdit');
            
            if ($image == null) {
                # code...
                //CREATE
                $data_admin->name = $request->AdminNameEdit;
                $data_admin->phone = $request->AdminPhoneEdit;
                $data_admin->save();
                return redirect()->back()->with('success', 'Data has been successfully saved!');
            }else {
                
                $imageName = $image->getClientOriginalName();
                $image->move(public_path('img/admin'), $imageName);
                $data_admin->Img = $imageName;
                //CREATE
                $data_admin->name = $request->AdminNameEdit;
                $data_admin->phone = $request->AdminPhoneEdit;
                $data_admin->save();
                return redirect()->back()->with('success', 'Data has been successfully saved!');
            }
        } else {
            // Handle other methods
            return response()->json(['message' => 'Method not allowed'], 405);
        }
    }

    public function destroy($id)
    {
        $data_admin= Admin::where('id', $id)->findOrFail($id);
        if ($data_admin->delete()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
    
}
