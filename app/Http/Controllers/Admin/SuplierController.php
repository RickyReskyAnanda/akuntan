<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\SuplierModel;
use App\Model\JurnalUmumModel;
use App\Model\ProyekModel;
use Auth;

class SuplierController extends Controller
{
    public function viewSuplier(){

        if(Auth::user()->level == 'admin'){
            $data = SuplierModel::where('jenis','suplier')->get();
        }elseif(Auth::user()->level == 'karyawan'){
            $data = SuplierModel::where('jenis','suplier')->where('id_user',Auth::user()->id)->get();
        }
    	return view('suplier.suplier',compact('data'));
    }
    public function getDataSuplier(){
        $data = SuplierModel::where('jenis','suplier')->get();

        for ($i=0; $i < count($data); $i++) { 
            $data[$i]->id = encConvId($data[$i]->id_suplier);

            unset($data[$i]->id_suplier); 
        }
        return $data;
    }


	public function postAddSuplier(Request $request){
		$this->validate($request,[
			'nama_suplier'  => 'required',
            'no_telp'       => 'required',
            'alamat'        => 'required',
            'merk'          => 'nullable',
		]);

		$data = new SuplierModel;
		$data->name 	    = ucwords($request->nama_suplier);
        $data->no_telp      = $request->no_telp;
        $data->alamat       = $request->alamat;
        if(isset($request->merk))
            $data->merk         = $request->merk;
        $data->sts          = '1';
		$data->jenis        = 'suplier';
		$data->save();

        $data->id = encConvId($data->id_suplier); //mengubah ke ascii

        unset($data->id_suplier);
        unset($data->created_at);
        unset($data->updated_at);
        return $data;
    }

    public function viewEditSuplier($id){
        $id = base64_decode(base64_decode($id));
        return SuplierModel::find($id);
    }

        public function postEditSuplier(Request $request){

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
            
            return redirect('administrator/suplier')->with('pesan','Data suplier telah diperbaharui !');
        }

    public function postDeleteSuplier($id){
        $id=decConvId($id);
        SuplierModel::destroy($id);

        return redirect('administrator/suplier')->with('pesan','Data suplier telah dihapus !');
    }

    public function viewDetailSuplier($id){
        $id = decConvId($id);
        $detail = SuplierModel::find($id);

        if(!isset($detail->id_suplier))//mengecek jika data tdk ada 
            return redirect()->back()->with('pesan','Data tidak tersedia !');
        
        return view('suplier.detail-suplier',compact('detail'));
    }
    public function getDetailSuplier($id_suplier){
        $id = decConvId($id_suplier);
        $data = JurnalUmumModel::rightJoin('proyek','jurnal_umum.id_proyek','proyek.id_proyek')->where('jurnal_umum.id_suplier',$id)->get(); //get data dari jurnal umum by id suplier

        for ($i=0; $i < count($data); $i++) { 
            $data[$i]->proyek_id = encConvId($data[$i]->id_proyek); // enkripsi base 64  id proyek
            unset($data[$i]->id_proyek); // hapus real id_proyek 
        }
        return $data;

    }

    public function viewDetailProyekSuplier($id_suplier,$id_proyek){
        $idSuplier = decConvId($id_suplier);
        $idProyek = decConvId($id_proyek);

        $suplier = SuplierModel::find($idSuplier);
        $proyek = ProyekModel::find($idProyek);

        $proyek->pembelian = 'Rp.'.number_format(JurnalUmumModel::where('id_proyek',$idProyek)->where('id_suplier',$idSuplier)->sum('harga_total'));


        if(!isset($suplier->id_suplier))//mengecek jika data tdk ada 
            return redirect()->back()->with('pesan','Data tidak tersedia !');
        if(!isset($proyek->id_proyek))//mengecek jika data tdk ada 
            return redirect()->back()->with('pesan','Data tidak tersedia !');

        return view('suplier.detail-proyek',compact('suplier','proyek'));
    }

    public function getDataJurnalUmumSuplier($id_suplier,$id_proyek){//data jurnal umum dari dari proyek terpilih
        $idSuplier = decConvId($id_suplier);
        $idProyek = decConvId($id_proyek);

        $data = JurnalUmumModel::where('id_proyek',$idProyek)->where('id_suplier',$idSuplier)->get();

        for ($i=0; $i < count($data); $i++) { 
            $data[$i]->harsat = "Rp.".number_format($data[$i]->harga_satuan); 
            unset($data[$i]->harga_satuan);
            $data[$i]->hartot = "Rp.".number_format($data[$i]->harga_total); 
            unset($data[$i]->harga_total);
        }

        return $data;
    }
}
