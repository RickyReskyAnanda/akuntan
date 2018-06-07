<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\SuplierModel;
use Auth;

class KontakController extends Controller
{
    public function viewKontak(){
        $data = SuplierModel::where('jenis','kontak')->where('id_admin',Auth::guard('admin')->user()->id)->get();
    	return view('admin.kontak.kontak',compact('data'));
    }

	public function postAddKontak(Request $request){
		$this->validate($request,[
			'nama_kontak'  => 'required',
            'nomor'         => 'required',
            'alamat'        => 'required',
		]);

		$data = new SuplierModel;
		$data->id_admin		= Auth::guard('admin')->user()->id;
		$data->name 	    = ucwords($request->nama_kontak);
        $data->no_telp      = $request->nomor;
        $data->alamat       = $request->alamat;
        $data->sts          = '1';
		$data->jenis          = 'kontak';
		$data->save();

        return redirect('administrator/kontak')->with('pesan','Data kontak telah ditambahkan !');
    }

    public function viewEditKontak($id){
        $id = base64_decode(base64_decode($id));
        return SuplierModel::find($id);
    }

        public function postEditKontak(Request $request){

            $this->validate($request,[
                'id_suplier' => 'required',
                'nama_suplier' => 'required',
                'nomor' => 'required|numeric',
                'alamat' => 'required',
            ]);
            $id = base64_decode(base64_decode($request->id_suplier));

            $data = SuplierModel::find($id);
            $data->name = ucwords($request->nama_suplier);
            $data->no_telp = $request->nomor;
            $data->alamat = $request->alamat;
            $data->save();
            
            return redirect('administrator/kontak')->with('pesan','Data kontak telah diperbaharui !');
        }

    public function postDeleteKontak($id){
        $id=base64_decode(base64_decode($id));
        SuplierModel::destroy($id);

        return redirect('administrator/kontak')->with('pesan','Data kontak telah dihapus !');
    }
}
