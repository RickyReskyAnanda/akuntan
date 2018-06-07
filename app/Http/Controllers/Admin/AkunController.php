<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin;
use Auth;

class AkunController extends Controller
{
    public function viewAkun(){
    	return view('akun.akun');
    }

    public function postEditAkun(Request $request){
    	$this->validate($request,[
    		'nama' => 'required',
    		'nomor' => 'required',
    		'alamat' => 'required',
    	]);

    	$data = Admin::find(Auth::guard('admin')->user()->id);
    	$data->name = $request->nama;
    	$data->username = $request->nomor;
    	$data->alamat = $request->alamat;
    	$data->save();
    	return redirect()->back()->with('pesan','Data Akun telah diperbaharui');
    }

    public function postEditGantiPassword(){
    	$this->validate($request,[
    		'passwordlama' => 'required',
    		'passwordbaru' => 'required',
    		'ulangipasswordbaru' => 'required'
    	]);

    	$data = Admin::find(Auth::guard('admin')->user()->id);

    	if(bcrypt($request->passwordlama)==$data->password){
    		if($request->passwordbaru == $request->ulangipasswordbaru){
    			$data->password = bcrypt($request->passwordbaru);
    			$data->save();
    		}else{
		    	return redirect()->back()->with('pesan','Password tidak sama');
    		}
    	}else{
	    	return redirect()->back()->with('pesan','Password lama salah');
    	}
    	return redirect()->back()->with('pesan','Password telah diperbaharui');
    }
}
