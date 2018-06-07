<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Model\ProyekModel;
use App\Model\SuplierModel;
use App\Model\BukuBesarModel;
use App\Model\JurnalUmumModel;

class ProyekController extends Controller
{
    private function getConv($id){
        return base64_decode(base64_decode($id));
    }
    private function postConv($id){
        return base64_encode(base64_encode(strval($id)));
    }

    public function viewProyek(){
        $proyek = ProyekModel::all();
        return view('proyek.proyek',compact('proyek'));
    }

    	public function postAddProyek(Request $request){
    		$this->validate($request,[
    			'nama_proyek' => 'required',
                'pemilik'  => 'required',
                'lokasi'  => 'required',
                'tahun'  => 'required',
    		]);

    		$data = new ProyekModel;
    		$data->nama_proyek 	= ucfirst($request->nama_proyek);
    		$data->pemilik = ucwords($request->pemilik);
    		$data->lokasi = $request->lokasi;
            $data->tahun  = $request->tahun; 
            $data->status = 'berjalan'; 
            $data->debit = 0; 
            $data->kredit = 0; 
    		$data->saldo = 0; 
    		$data->save();


            $kode = array(
                array('id_proyek'=>$data->id_proyek, 'nama'=> 'Modal','tipe'=>'debit','kode'=>'a'),
                array('id_proyek'=>$data->id_proyek, 'nama'=> 'Pembelian','tipe'=>'kredit','kode'=>'b'),
                array('id_proyek'=>$data->id_proyek, 'nama'=> 'Penjualan','tipe'=>'debit','kode'=>'c'),
                array('id_proyek'=>$data->id_proyek, 'nama'=> 'Hutang','tipe'=>'debit','kode'=>'d'),
            );

            BukuBesarModel::insert($kode);

            return redirect('backoffice/proyek/detail/'.base64_encode(base64_encode(strval($data->id_proyek))))->with('pesan','Data proyek telah ditambahkan !');
        }

        public function viewDetailProyek($id){
            $id = base64_decode(base64_decode($id));

            $detail = ProyekModel::find($id);
            $suplierData = SUplierModel::all();

            return view('proyek.detail-proyek',compact('detail','suplierData'));
        }

        /*Application Programming Interface*/
        public function getKode($id_proyek){
            $id_proyek = base64_decode(base64_decode($id_proyek));

            $data = BukuBesarModel::where('id_proyek',$id_proyek)->get();
            
            for ($i=0; $i < count($data); $i++) { 
                $data[$i]->id_bb = base64_encode(base64_encode(strval($data[$i]->id_buku_besar)));
                $data[$i]->id_buku_besar = 0;
                $data[$i]->id_proyk = base64_encode(base64_encode(strval($data[$i]->id_proyek)));
                $data[$i]->id_proyek = 0;
            }

            return $data;
        }
        public function postAddKode(Request $request){
            $this->validate($request,[
                'id_proyek' => 'required',
                'nama_buku_besar' => 'required',
                'jenis' => 'required',
            ]);

            $data = new BukuBesarModel;
            $data->id_proyek = base64_decode(base64_decode($request->id_proyek));
            $data->nama = ucfirst($request->nama_buku_besar);
            $data->tipe = $request->jenis;
            $data->kode = 'e';
            $data->save();

            return 'success';
        }
        public function postDeleteKode($idBukuBesar,$kodeBukuBesar){
            $idBukuBesar = base64_decode(base64_decode($idBukuBesar));
            $data = BukuBesarModel::where('id_buku_besar',$idBukuBesar)->where('kode',$kodeBukuBesar)->first();
            $namaKode = $data->nama;
            $data->delete();
            return 'Kode '.$namaKode.' telah dihapus';
            // return $data;
        }

        public function getDataBukuBesar($id_bb,$id_proyek){
            $id_proyek = base64_decode(base64_decode($id_proyek));
            $id_bb = base64_decode(base64_decode($id_bb));
            $data = JurnalUmumModel::where('id_buku_besar',$id_bb)->where('id_proyek',$id_proyek)->orderBy('tanggal','asc')->get();

            $dataBB = BukuBesarModel::find($id_bb);

            for ($i=0; $i < count($data); $i++) { 
                $data[$i]->kode = $dataBB->nama;
                if($data[$i]->tipe == 'debit'){
                    $data[$i]->debit = rupiah($data[$i]->harga_total);
                    $data[$i]->kredit = " ";
                }else if($data[$i]->tipe == 'kredit'){
                    $data[$i]->debit = " ";
                    $data[$i]->kredit = rupiah($data[$i]->harga_total);
                }

                $data[$i]->jurnal_umum_id = base64_encode(base64_encode(strval($data[$i]->id_jurnal_umum)));
                $data[$i]->suplier_id = base64_encode(base64_encode(strval($data[$i]->id_suplier)));
                $data[$i]->proyek_id = base64_encode(base64_encode(strval($data[$i]->id_proyek)));
                $data[$i]->buku_besar_id = base64_encode(base64_encode(strval($data[$i]->id_buku_besar)));

                unset($data[$i]->id_jurnal_umum);
                unset($data[$i]->id_suplier);
                unset($data[$i]->id_proyek);
                unset($data[$i]->id_buku_besar);


                if(!empty($data[$i]->harga_satuan)){
                    $data[$i]->harga_satuan = rupiah($data[$i]->harga_satuan);
                }else{
                    $data[$i]->harga_satuan = ' ';
                }

                if(empty($data[$i]->volume)){
                    $data[$i]->volume = ' ';
                }
                if(empty($data[$i]->satuan)){
                    $data[$i]->satuan = ' ';
                }
            }
            return $data;

        }


//------------ jurnal Umum ----------------
    public function postAddJurnalUmum(Request $request){
        // $this->validate($request,[
        //     'id_proyek' => 'required',
        //     'id_bb' => 'required',
        //     'jns_suplier' => 'required',
        //     'tanggal' => 'required',
        //     'no_nota' => 'required',
        //     'uraian' => 'required',
        //     'volume' => 'required',
        //     'satuan' => 'nullable',
        //     'harsat' => 'required',
        // ]);
        // return $request->all();


        $id_proyek = base64_decode(base64_decode($request->id_proyek));
        $id_bb = base64_decode(base64_decode($request->id_bb));
        $dataBuku = BukuBesarModel::find($id_bb);

        $data = new JurnalUmumModel;
        if($request->suplieroption == '1' && $dataBuku->kode != 'a'){
            $data->id_suplier = base64_decode(base64_decode($request->id_suplier));
            
        }elseif($request->suplieroption == '2' && $dataBuku->kode != 'a'){
            $suplier = new SuplierModel;
            $suplier->name = $request->nama_suplier;
            $suplier->alamat = $request->alamat;
            $suplier->no_telp = $request->no_telp;
            $suplier->sts = '1';
            
            if($dataBuku->tipe == 'debit')
                $suplier->jenis = 'kontak';
            else
                $suplier->jenis = 'suplier';

            $suplier->save();
            $data->id_suplier = $suplier->id_suplier;
        }

        $data->tanggal = date("Y-m-d", strtotime($request->tanggal));
        $data->id_proyek = $id_proyek;
        $data->id_buku_besar = $id_bb;
        $data->kode_buku_besar = $dataBuku->kode;
        $data->no_nota = $request->no_nota; // mau dikolaborasikan dengan tanggal
        $data->uraian = $request->uraian;
        $data->tipe    = $dataBuku->tipe;
        
        if($dataBuku->kode == 'a'){
            $data->harga_total = $request->harga_total;
        }else{
            $data->volume = $request->volume;
            $data->satuan = $request->satuan;
            $data->harga_satuan = $request->harga_satuan;
            $data->harga_total = $data->volume*$data->harga_satuan;
        }

        
        $proyekData = ProyekModel::find($id_proyek);//penginputan data
        if($dataBuku->tipe == 'debit') //menentukan di jumlah atau dikurangi
            $proyekData->saldo += $data->harga_total;
        else
            $proyekData->saldo -= $data->harga_total;


        $data->saldo = $proyekData->saldo;

        $data->save();

        if($request->paymentoption == '2'){
            $dataHutang = new JurnalUmumModel;
            $dataHutang->tanggal        = $data->tanggal;
            $dataHutang->id_suplier     = $data->id_suplier;
            $dataHutang->id_proyek      = $data->id_proyek;

            $dataBBHutang = BukuBesarModel::where('id_proyek',$data->id_proyek)->where('kode','d')->first();

            $dataHutang->id_buku_besar  = $dataBBHutang->id_buku_besar;
            $dataHutang->no_nota        = $data->no_nota; // mau dikolaborasikan dengan tanggal
            $dataHutang->uraian         = $data->uraian;
            $dataHutang->volume         = $data->volume;
            $dataHutang->satuan         = $data->satuan;
            $dataHutang->harga_satuan   = $data->harga_satuan;
            $dataHutang->harga_total    = $data->harga_total - $request->downpayment;
            $dataHutang->tipe           = 'debit';

            $proyekData->saldo += $dataHutang->harga_total; // penambahan jumlah hartot ke saldo proyek
            $dataHutang->saldo = $proyekData->saldo;//mencatat jumlah saldo setelah ditambahkan
            $dataHutang->save();
        }

        $proyekData->save();

        return 'success';
    }

    public function getDataJurnalUmum($id_proyek){
        $id_proyek = base64_decode(base64_decode($id_proyek));
        $data = JurnalUmumModel::where('jurnal_umum.id_proyek',$id_proyek)
                                ->orderBy('jurnal_umum.tanggal','asc')
                                ->leftJoin('buku_besar','jurnal_umum.id_buku_besar','buku_besar.id_buku_besar')
                                ->get();

        $value['totalbb']['modal'] = 0;   
        $value['totalbb']['pembelian'] = 0;   
        $value['totalbb']['penjualan'] = 0;
        
        $dataProyek = ProyekModel::find($id_proyek);
        $value['totalbb']['saldo'] = rupiah($dataProyek->saldo);
        $saldo = $dataProyek->saldo;
        
        $jumlahKredit = 0;
        $jumlahDebit = 0;
        for ($i=0; $i < count($data); $i++) { 
            if($data[$i]->kode == 'a'){
                $value['totalbb']['modal'] +=$data[$i]->harga_total;   
            }elseif($data[$i]->kode == 'b'){
                $value['totalbb']['pembelian'] +=$data[$i]->harga_total;   
            }elseif($data[$i]->kode == 'c'){
                $value['totalbb']['penjualan'] +=$data[$i]->harga_total;   
            }
            if($data[$i]->tipe == 'debit'){
                $jumlahDebit += $data[$i]->harga_total;
                $data[$i]->debit = rupiah($data[$i]->harga_total);
                $data[$i]->kredit = " ";

            }else if($data[$i]->tipe == 'kredit'){
                $jumlahKredit += $data[$i]->harga_total;
                $data[$i]->debit = " ";
                $data[$i]->kredit = rupiah($data[$i]->harga_total);
            }
            $data[$i]->saldo = rupiah($data[$i]->saldo); 
            if(!empty($data[$i]->harga_satuan)){
                $data[$i]->harga_satuan = rupiah($data[$i]->harga_satuan);
            }else{
                $data[$i]->harga_satuan = ' ';
            }

            if(empty($data[$i]->volume)){
                $data[$i]->volume = ' ';
            }
            if(empty($data[$i]->satuan)){
                $data[$i]->satuan = ' ';
            }
        }

        $value['totalbb']['modal'] = rupiah($value['totalbb']['modal']);   
        $value['totalbb']['pembelian'] = rupiah($value['totalbb']['pembelian']);   
        $value['totalbb']['penjualan'] = rupiah($value['totalbb']['penjualan']);
        $value['totaljurnal']['debit'] = rupiah($jumlahDebit);
        $value['totaljurnal']['kredit'] = rupiah($jumlahKredit);
        $value['jurnalumum'] = $data;

        return $value;   

    }

    public function postDataPembayaranHutangJurnalUmum($id_jurnal_umum){
        $id = $this->getConv($id_jurnal_umum);
        $data = JurnalUmumModel::find($id);
        $proyek = ProyekModel::find($data->id_proyek);

        if($data->harga_total < $proyek->saldo){
            $proyek->saldo = $proyek->saldo - $data->harga_total;
            $proyek->save();

            $data->delete();

            return 'success';

        }else{
            return 'failed';
        }
    }

    public function postDeleteDataJurnalUmum($id_jurnal_umum){
        $id = $this->getConv($id_jurnal_umum);
        if(JurnalUmumModel::destroy($id))
            return 'success';
        else 
            return 'failed';
    }

    public function getEditDataJurnalUmum($id_jurnal_umum){
        $id = base64_decode(base64_decode(strval($id_jurnal_umum)));
        
    }
    public function postEditDataJurnalUmum($id_jurnal_umum){
        $id = base64_decode(base64_decode(strval($id_jurnal_umum)));

    }

}
