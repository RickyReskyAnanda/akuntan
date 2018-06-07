<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use File;
class UserController extends Controller
{
    public function viewUser(){
        return view('user.user');
    }
    public function getDataUser(){
        $data = User::all();

        for ($i=0; $i < count($data); $i++) { 
            $data[$i]->user_id = encConvId($data[$i]->id);//enckripsi base 64 ke variable lain
            unset($data[$i]->id);//menghapus data asli
        }
        return $data;
    }

	public function postAddUser(Request $request){

		$this->validate($request,[
			'nama_user' 	=> 'required',
            'no_telp_user'  => 'required|numeric',
            'alamat'    => 'required',
            'level'    => 'required',
		]);


		$data = new User;
        $data->name = ucfirst($request->nama_user);
        $data->alamat = $request->alamat;
        $data->level = $request->level;
        $data->username = $request->no_telp_user;
        $data->password = bcrypt($request->no_telp_user); //password defaultnya adalah nomor telpnya
        $data->sts  = "0";

        // if($request->hasFile('gambar')){
        //     $berita->gambar = date('Ymdhis').'.'.$request->gambar->getClientOriginalExtension();
        //     //upload image 
        //     $request->gambar->move(public_path('images/gambar/'),$berita->gambar);

        //     //resize image
        //     $pathFind = public_path('images/gambar/'.$berita->gambar);
        //     $pathSave = public_path('images/gambar/thumb/'.$berita->gambar);
        //     Image::make($pathFind)->resize(200, 200)->save($pathSave);
        // }

		$data->save();

    	return response("success",200);

	}

    public function getEditUser($id_user){
        $id = decConvId($id_user);
        $data = User::find($id);

        $data->user_id = encConvId($data->id);
        unset($data->id);
        return $data;
    }

        public function postEditUser(Request $request){
            $this->validate($request,[
                'user_id'     => 'required',
                'nama_user'     => 'required',
                'no_telp_user'  => 'required|numeric',
                'alamat'  => 'required',
                'level'  => 'required',
                'status'  => 'required',
            ]);


            $id = decConvId($request->user_id);
            $data = User::find($id);
            $data->name = ucfirst($request->nama_user);
            $data->username = $request->no_telp_user;
            $data->level = $request->level;
            $data->alamat = $request->alamat;
            $data->sts = $request->status;
            $data->save();
            return response('success', 200);
            
        }
   
        public function postDeleteUser($id_user){
            $id = decConvId($id_user);
            $data = User::find($id);
            if($data->level != "superadmin"){
                $data->delete();
                return response("success",200);
            }else return responese("failed",200);
        }

        public function postResetPasswordUser($id_user){
            $id = decConvId($id_user);
            // return $id;
            $data = User::find($id);
            $data->password = bcrypt($data->username);
            $data->sts  = '0';
            $data->save();
            
            return response("success",200);
        }
}
