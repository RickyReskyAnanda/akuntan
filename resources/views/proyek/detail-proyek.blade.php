@extends('index')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Proyek</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('backoffice')}}">Dashboard</a>
            </li>
            <li class="active">
                <strong>Proyek</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">    <!-- Modal Menambahkan User START -->
    <div class="ibox" id="ibox1">
        <div class="ibox-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="m-b-md">
                        <a class="btn btn-warning btn-sm pull-right" type="button" data-toggle="modal" data-target="#editProject"><i class="fa fa-edit"></i> | Edit Project</a>
                        <h2>{{$detail->nama_proyek}}</h2>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-bottom:20px;">
                <div class="col-lg-4">
                    <dl class="dl-vertical">
                        <dt class="badge badge-info"><i class="fa fa-user"></i> Pemilik Project </dt>
                        <dd style="margin: 5px 18px;">{{$detail->pemilik}}</dd><hr>
                        <dt class="badge badge-info"><i class="fa fa-map-marker"></i> Lokasi </dt>
                        <dd style="margin: 5px 18px;">{{$detail->lokasi}}</dd><hr>
                        <dt class="badge badge-info"><i class="fa fa-calendar"></i> Status </dt>
                        <dd style="margin: 5px 18px;">{{$detail->status}}</dd>
                    </dl>
                </div>
                <div class="col-md-3" style="margin-bottom: 20px">
                    <div class="col-md-12">
                        <div>
                            <p>Saldo</p>
                            <h2 class="no-margins" id="showSaldo"></h2>
                            <div class="progress progress-mini">
                                <div class="progress-bar progress-bar-success" style="width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="col-md-4">
                        <p>Modal (Debit)</p>
                        <h3 class="no-margins" id="showModal"></h3>
                        <div class="progress progress-mini">
                            <div class="progress-bar" style="width: 100%;"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <p>Penjualan (Debit)</p>
                        <h3 class="no-margins" id="showPenjualan"></h3>
                        <div class="progress progress-mini">
                            <div class="progress-bar" style="width: 100%;"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <p>Pembelian (Kredit)</p>
                        <h3 class="no-margins" id="showPembelian"></h3>
                        <div class="progress progress-mini">
                            <div class="progress-bar" style="width: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tabs-container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab-1"> Jurnal Umum</a></li>
            <li class=""><a data-toggle="tab" href="#tab-2">Buku Besar</a></li>
        </ul>
        <div class="tab-content">
            <div id="tab-1" class="tab-pane active">
                <div class="panel-body">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content table-responsive">
                            <table class="table table-bordered  table-hover dataTables-example" id="tabelJurnal">
                                <thead>         
                                    <tr>
                                        <th rowspan="2" style="padding-top:25px; text-align: center; font-size: 13px;" >Tanggal</th>
                                        <th rowspan="2" style="padding-top:25px; text-align: center; font-size: 13px;">No Nota</th>
                                        <th rowspan="2" style="padding-top:25px; text-align: center; font-size: 13px;">Kode</th>
                                        <th colspan="4" style="text-align: center;font-size: 13px;">Deskripsi</th>
                                        <th rowspan="2" style="padding-top:25px; text-align: center; font-size: 13px;">Debit</th>
                                        <th rowspan="2" style="padding-top:25px; text-align: center; font-size: 13px;">Kredit</th>
                                        <th rowspan="2" style="padding-top:25px; text-align: center; font-size: 13px;">Saldo</th>
                                    </tr>
                                    <tr>
                                        <th style="text-align: center; font-size: 13px;">Uraian</th>
                                        <th style="text-align: center; font-size: 13px;">Vol.</th>
                                        <th style="text-align: center; font-size: 13px;">Sat.</th>
                                        <th style="text-align: center; font-size: 13px;">Harga Satuan</th>
                                    </tr>
                                </thead>
                                <tbody id="listJurnalUmum">
                                    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="7" style="text-align: right">Total</th>
                                        <th id="totalJurnalDebitID"></th>
                                        <th id="totalJurnalKreditID"></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div id="tab-2" class="tab-pane ">
                <div class="panel-body">

                    <div class="tabs-container">
                        <ul class="nav nav-tabs" id="listKode">
                            <li data-toggle="modal" data-target="#myModalKode"><a href="javascript:;"> <i class="fa fa-plus-square"></i></a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="kode-1" class="tab-pane active">
                                <div class="panel-body">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-tools pull-left" >
                                            <button class="btn btn-primary dim" id="btnTambahJUrnal" data-toggle="modal" data-target="#myModalJurnal" type="button" >
                                                <i class="fa fa-book"></i> | Tambah Jurnal Umum
                                            </button>
                                          <!--   <button class="btn btn-success dim"  type="button" >
                                                <i class="fa fa-print"></i> | Cetak
                                            </button>
 -->                                            
                                            <button class="btn btn-danger dim " data-toggle="dropdown"  type="button" id="btnSettingKode">
                                                <i class="fa fa-wrench"></i> | Setting
                                            </button>
                                            <ul class="dropdown-menu dropdown-user" >
                                                <li>
                                                    <a href="" data-toggle="modal" data-target="#myModalKode"><i class="fa fa-wrench"></i> Ubah Kode</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;" id="btnHapusKode" ><i class="fa fa-trash"></i> Hapus Kode</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="ibox-content table-responsive">
                                            <table class="table table-bordered table-hover" id="tabelBuku">
                                                <thead>         
                                                    <tr>
                                                        <th rowspan="2" style="padding-top:25px; text-align: center; font-size: 13px;" >Tanggal</th>
                                                        <th rowspan="2" style="padding-top:25px; text-align: center; font-size: 13px;">No Nota</th>
                                                        <th rowspan="2" style="padding-top:25px; text-align: center; font-size: 13px;">Kode</th>
                                                        <th colspan="4" style="text-align: center;font-size: 13px;">Deskripsi</th>
                                                        <th rowspan="2" style="padding-top:25px; text-align: center; font-size: 13px;">Debit</th>
                                                        <th rowspan="2" style="padding-top:25px; text-align: center; font-size: 13px;">Kredit</th>
                                                        <th rowspan="2" style="padding-top:25px; text-align: center; font-size: 13px;">Aksi</th>
                                                    </tr>
                                                    <tr>
                                                        <th style="text-align: center; font-size: 13px;">Uraian</th>
                                                        <th style="text-align: center; font-size: 13px;">Vol.</th>
                                                        <th style="text-align: center; font-size: 13px;">Sat.</th>
                                                        <th style="text-align: center; font-size: 13px;">Harga Satuan</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="listBukuBesar">
                                                    
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="7" style="padding-top: 15px;font-size: 13px; text-align: right; ">Total</th>
                                                        <th style="padding-top: 15px;font-size: 13px;">Rp.</th>
                                                        <th style="padding-top: 15px;font-size: 13px;">Rp.</th>
                                                        <th style="padding-top: 15px;font-size: 13px;"></th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div><!-- tab dalam -->

                </div>
            </div>
        </div>
    </div>
</div>
        <!-- content end -->
<div class="modal inmodal" id="myModalJurnal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">  
        <div class="modal-content animated bounceIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Tambah Jurnal Umum</h4>
            </div>
            <form class="form-horizontal" method="post" action="{{url('api/bukubesar/jurnalumum/tambah')}}" id="tambahJurnalUmum">
                <div class="modal-body">
                    {{csrf_field()}}
                    <input type="hidden" name="id_proyek" value="{{base64_encode(base64_encode(strval($detail->id_proyek)))}}">
                    <input type="hidden" name="id_bb" id="idBBJurnalUmum" value="">
                    <div class="form-group clsModalOption1">
                        <label class="col-lg-4 control-label">Jenis Suplier</label>
                        <div class="col-lg-3">
                            <label> <input type="radio" value="1" name="suplieroption" checked> <i></i> Suplier Lama </label>
                        </div>
                        <div class="col-lg-3">
                            <label> <input type="radio"  value="2" name="suplieroption"> <i></i> Suplier Baru </label>
                        </div>
                    </div>
                    <div class="form-group shsuplierlama clsModalOption1">
                        <label class="col-lg-4 control-label">Pilih Suplier</label>
                        <div class="col-lg-8">
                            <select class="form-control" multiple="" name="id_suplier">
                                @foreach($suplierData as $sd)
                                <option value="{{base64_encode(base64_encode(strval($sd->id_suplier)))}}">{{$sd->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group shsuplier clsModalOption1">
                        <label class="col-lg-4 control-label">Nama Suplier</label>
                        <div class="col-lg-8"><input type="text" name="nama_suplier" placeholder="Nama Suplier.." class="form-control"></div>
                    </div>
                    <div class="form-group shsuplier clsModalOption1">
                        <label class="col-lg-4 control-label">Alamat</label>
                        <div class="col-lg-8"><textarea class="form-control" name="alamat" placeholder="Alamat.."></textarea></div>
                    </div>
                    <div class="form-group shsuplier clsModalOption1">
                        <label class="col-lg-4 control-label">No Telpon</label>
                        <div class="col-lg-8"><input type="text" name="no_telp" placeholder="Nomor Telpon.." class="form-control"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Tanggal</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" data-mask="9999-99-99" name="tanggal" placeholder="Masukkan tanggal..">
                            <span class="help-block">TTTT-BB-HH</span>
                        </div>
                    </div>
                    <div class="form-group"><label class="col-lg-4 control-label">No Nota</label>
                        <div class="col-lg-8"><input type="text" name="no_nota" placeholder="Nomor Nota" class="form-control"></div>
                    </div>
                    <div class="form-group"><label class="col-lg-4 control-label">Uraian</label>
                        <div class="col-lg-8"><textarea class="form-control" rows="3" name="uraian" placeholder="Detail atau Uraian.."></textarea></div>
                    </div>
                    <div class="form-group clsModalOption1"><label class="col-lg-4 control-label">Volume</label>
                        <div class="col-lg-8"><input type="text" name="volume" placeholder="Volume.." class="form-control"></div>
                    </div>
                    <div class="form-group clsModalOption1"><label class="col-lg-4 control-label">Satuan</label>
                        <div class="col-lg-8"><input type="text" class="form-control" name="satuan" placeholder="Satuan.."></div>
                    </div>
                    <div class="form-group clsModalOption1"><label class="col-lg-4 control-label">Harga Satuan</label>
                        <div class="col-lg-8">
                            <div class="input-group">
                                <span class="input-group-addon">Rp.</span> 
                                <input type="number" name="harga_satuan" class="form-control" placeholder="000000"> <span class="input-group-addon">.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group clsModalOption2"><label class="col-lg-4 control-label">Total</label>
                        <div class="col-lg-8">
                            <div class="input-group">
                                <span class="input-group-addon">Rp.</span> 
                                <input type="number" name="harga_total" class="form-control" placeholder="000000"> <span class="input-group-addon">.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group clsModalOption1" id="shpaymentoption">
                        <label class="col-lg-4 control-label">Jenis Pembayaran</label>
                        <div class="col-lg-3">
                            <label> <input type="radio" value="1" name="paymentoption" checked> <i></i> Tunai </label>
                        </div>
                        <div class="col-lg-3">
                            <label> <input type="radio"  value="2" name="paymentoption"> <i></i> Hutang </label>
                        </div>
                    </div>
                    <div class="form-group clsModalOption1" id="shpayment"><label class="col-lg-4 control-label">Down Payment</label>
                        <div class="col-lg-8"><input type="number" class="form-control" name="downpayment" placeholder="Down Payment.."></div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-white" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Menambahkan User START -->
    <div class="modal inmodal" id="myModalKode" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">  
        <div class="modal-content animated bounceIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <i class="fa fa-book modal-icon"></i> 
                    <h4 class="modal-title">Tambah Buku Besar</h4>
                </div>
                <form class="form-horizontal" action="{{url('api/bukubesar/kode/tambah')}}" method="post" id="tambahKode">
                    <input type="hidden" name="id_proyek" value="{{base64_encode(base64_encode(strval($detail->id_proyek)))}}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Nama Buku Besar</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="nama_buku_besar" placeholder="Masukkan Nama Buku Besar" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Jenis</label>
                             <div class="col-lg-8">
                                <div>
                                    <label class="checkbox-inline"><input type="radio" name="jenis" value="debit" checked=""> Debit</label>
                                    <label class="checkbox-inline"><input type="radio" name="jenis" value="kredit"> Kredit</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Menambahkan User END -->
    <!-- Modal Menambahkan User START -->
    <div class="modal inmodal" id="myModalKode" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">  
        <div class="modal-content animated bounceIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <i class="fa fa-book modal-icon"></i> 
                    <h4 class="modal-title">Edit Buku Besar</h4>
                </div>
                <form class="form-horizontal" action="{{url('api/bukubesar/kode/tambah')}}" method="post" id="tambahKode">
                    <input type="hidden" name="id_proyek" value="{{base64_encode(base64_encode(strval($detail->id_proyek)))}}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Nama Buku Besar</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="nama_buku_besar" placeholder="Masukkan Nama Buku Besar" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Jenis</label>
                             <div class="col-lg-8">
                                <div>
                                    <label class="checkbox-inline"><input type="radio" name="jenis" value="debit" checked=""> Debit</label>
                                    <label class="checkbox-inline"><input type="radio" name="jenis" value="kredit"> Kredit</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Menambahkan User END -->

<script type="text/javascript">
    var tjurnal = $('#tabelJurnal').DataTable({
            pageLength: 25,
            autoWidth: true,
            responsive: true,
            
        });

    var tbuku = $('#tabelBuku').DataTable({
            pageLength: 25,
            autoWidth: false,
            responsive: true,
           
        });



    var idProyek = '{{base64_encode(base64_encode(strval($detail->id_proyek)))}}';

    $('.shsuplier').hide();


    $('#shpaymentoption').hide();
    $('#shpayment').hide();

    $('#btnSettingKode').hide();


    $('input[type=radio][name=suplieroption]').change(function() {
        if (this.value == '1') {
           $('.shsuplierlama').show();
           $('.shsuplier').hide();
        }
        else if (this.value == '2') {
           $('.shsuplier').show();
           $('.shsuplierlama').hide();
        }
    });

    var idBukuBesar = 'kosong'; 
    var kodeBukuBesar = 'a'; 
    var tipeBukuBesar = 'debit'; 


    //kode
    var getKode = function(){
        $.get("{{url('api/bukubesar/kode')}}/"+idProyek, function(data, status){
            // alert("Data: " + data + "\nStatus: " + status);
            $('#listKode').html(' ');
            for(var i=0;i<data.length;i++){
                if(i == 0){
                    $('#listKode').append('<li class="active"><a class="listKode" data-toggle="tab" href="#kode-x" data-tipe="'+data[i]['tipe']+'" data-kode="'+data[i]['kode']+'" data-id="'+data[i]['id_bb']+'">'+data[i]['nama']+' <small>('+data[i]['tipe']+')</small></a></li>');
                    idBukuBesar = data[i]['id_bb'];
                    kodeBukuBesar = data[i]['kode'];
                    $('#idBBJurnalUmum').val(idBukuBesar);
                }else{
                    $('#listKode').append('<li><a class="listKode" data-toggle="tab" href="#kode-x" data-tipe="'+data[i]['tipe']+'" data-kode="'+data[i]['kode']+'" data-id="'+data[i]['id_bb']+'">'+data[i]['nama']+' <small>('+data[i]['tipe']+')</small></a></li>');
                }
            }
            $('#listKode').append('<li data-toggle="modal" data-target="#myModalKode"><a href="javascript:;"> <i class="fa fa-plus-square"></i></a></li>');
            getDataBukuBesar();
            $('#btnSettingKode').hide();

        });
    }

    setTimeout(
      function() 
      {
        getKode();
        getDataJurnalUmum();
      }, 1500);


    // tambah kode
    $("#tambahKode").submit(function(event){


        event.preventDefault(); //prevent default action 
        var post_url = $(this).attr("action"); //get form action url
        var request_method = $(this).attr("method"); //get form GET/POST method
        var form_data = $(this).serialize(); //Encode form elements for submission
        
        // $('#myModalKode').modal('hide');

        $.ajax({
            url : post_url,
            type: request_method,
            data : form_data
        }).done(function(response){ //
            if(response=='success'){
                getKode();
            }else{
                alert('ada kesalahan !');
            }
        });
    });

    var setModalDefault = function(kondisi){
        if(kondisi == 1){
            $('.clsModalOption1').hide();
            $('.clsModalOption2').show();


        }else{
            $('.clsModalOption1').show();
            $('.clsModalOption2').hide();
            $('.shsuplier').hide();
            $('#shpayment').hide();
        }
            
    }
    setModalDefault(1);

    $(document).on("click", '.listKode', function() { 
        kodeBukuBesar = $(this).attr('data-kode');
        idBukuBesar = $(this).attr('data-id');
        tipeBukuBesar = $(this).attr('data-tipe');

        $('#idBBJurnalUmum').val(idBukuBesar);
        
        if (kodeBukuBesar=='a'){
            setModalDefault(1);
        }else{
            setModalDefault(2);
        }

        if (kodeBukuBesar=='d'){
            $('#btnTambahJUrnal').hide();
        }else{
            $('#btnTambahJUrnal').show();
        }

        if (kodeBukuBesar=='e') {
            $('#btnSettingKode').show();
        }else{
            $('#btnSettingKode').hide();
        }


        if(tipeBukuBesar == 'debit'){
            $('#shpaymentoption').hide();
        }else if(tipeBukuBesar == 'kredit'){
            $('#shpaymentoption').show();
        }

        // alert(idBukuBesar);
        getDataBukuBesar();

    });

    $('#btnHapusKode').click(function(){
        $.get("{{url('api/bukubesar/kode/delete')}}/"+idBukuBesar+'/'+kodeBukuBesar, function(data, status){
            getKode();
            alert(data);
        });
    });

    //data buku besar
    var getDataBukuBesar = function(){
        $.get("{{url('api/bukubesar/kode/data')}}/"+idBukuBesar+'/'+idProyek, function(data, status){

                tbuku.clear().draw();
                for(var i = 0; i < data.length; i++) { 
                    if(kodeBukuBesar == 'd'){
                        t.row.add( [
                            data[i]['tanggal'],
                            data[i]['no_nota'],
                            data[i]['kode'],
                            data[i]['uraian'],
                            data[i]['volume'],
                            data[i]['satuan'],
                            data[i]['harga_satuan'],
                            data[i]['debit'],
                            data[i]['kredit'],
                            '<button class="btn btn-sm btn-info btnBayarHutangJurnalUmum" type="button" data-id="'+data[i]['jurnal_umum_id']+'">'+
                                '<i class="fa fa-trash"></i> | Bayar'+
                            '</button>'
                        ] ).draw();
                    }else {
                        tbuku.row.add( [
                            data[i]['tanggal'],
                            data[i]['no_nota'],
                            data[i]['kode'],
                            data[i]['uraian'],
                            data[i]['volume'],
                            data[i]['satuan'],
                            data[i]['harga_satuan'],
                            data[i]['debit'],
                            data[i]['kredit'],
                            '<button class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#myModalBuku">'+
                                    '<i class="fa fa-user"></i> | Edit'+
                                '</button>'+
                                '<button class="btn btn-sm btn-danger btnHapusJurnalUmum" type="button" data-id="'+data[i]['jurnal_umum_id']+'">'+
                                    '<i class="fa fa-trash"></i> | Hapus'+
                                '</button>'
                        ] ).draw();
                    }
                } // End For  

        });
    }


    //event untuk tunai atau hutang
    $('input[type=radio][name=paymentoption]').change(function() {
        if($(this).val() == '1'){
            $('#shpayment').hide();
        }else if($(this).val() == '2'){
            $('#shpayment').show();
        }

    });
    // tambah jurnal umum
    $("#tambahSuplier").submit(function(event){

        event.preventDefault(); //prevent default action 
        var post_url = $(this).attr("action"); //get form action url
        var request_method = $(this).attr("method"); //get form GET/POST method
        var form_data = $(this).serialize(); //Encode form elements for submission
        
        $('#myModalJurnal').modal('hide');

        $.ajax({
            url : post_url,
            type: request_method,
            data : form_data
        }).done(function(response){ //
            
            if(response=='success'){
                getDataBukuBesar();
                getDataJurnalUmum();
            }else{
                alert('ada kesalahan, silahkan reload halaman !');
            }
        });
    });

    $(document).on("click", '.btnHapusJurnalUmum', function() { 
        var idJurnalUmum = $(this).attr('data-id');
         $.get("{{url('api/bukubesar/jurnalumum/hapus')}}/"+idJurnalUmum, function(data, status){
            if(data == 'success'){
                getDataBukuBesar();
                getDataJurnalUmum();
            }else{
                alert('Terjadi Kesalahan');
            }
        });
    });
    //bayar hutang jurnal umum
    $(document).on("click", '.btnBayarHutangJurnalUmum', function() { 
        var idJurnalUmum = $(this).attr('data-id');
        $.get("{{url('api/bukubesar/jurnalumum/pembayaran-hutang')}}/"+idJurnalUmum, function(data, status){
            if(data == 'success'){
                getDataBukuBesar();
                getDataJurnalUmum();
            }else{
                alert('Terjadi Kesalahan');
            }
        });
    });

    var getDataJurnalUmum = function(){
        $.get("{{url('api/bukubesar/jurnalumum/data')}}/"+idProyek, function(data, status){
            var jurnalUmum = data.jurnalumum; //mengunpan data jurnal umum ke variabel jurnal umum

            tjurnal.clear().draw();// membersihkan row pada tabel
            for(var i=0;i<jurnalUmum.length;i++){ //menambah row 
                tjurnal.row.add( [
                    jurnalUmum[i]['tanggal'],
                    jurnalUmum[i]['no_nota'],
                    jurnalUmum[i]['nama'],
                    jurnalUmum[i]['uraian'],
                    jurnalUmum[i]['volume'],
                    jurnalUmum[i]['satuan'],
                    jurnalUmum[i]['harga_satuan'],
                    jurnalUmum[i]['debit'],
                    jurnalUmum[i]['kredit'],
                    jurnalUmum[i]['saldo']
                ] ).draw();
            }

            //total debit dan kredit
            $('#totalJurnalKreditID').html(data.totaljurnal.kredit);
            $('#totalJurnalDebitID').html(data.totaljurnal.debit);

            //menampilkan di panel atas
            $('#showSaldo').html(data.totalbb.saldo);
            $('#showModal').html(data.totalbb.modal);
            $('#showPembelian').html(data.totalbb.pembelian);
            $('#showPenjualan').html(data.totalbb.penjualan);


        });
    }
</script>


    <!-- Modal Menambahkan User END -->
    
    <!-- Modal Edit Project start -->
        <!-- <div class="modal inmodal" id="editProject" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content animated bounceIn">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <i class="fa fa-edit modal-icon"></i>
                    <h4 class="modal-title">Edit Data Proyek</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="form-group"><label class="col-lg-4 control-label">Nama Project</label>
                            <div class="col-lg-8"><input type="text" name="nama_proyek" value="{{$detail->nama_proyek}}" placeholder="Nama Project ..." class="form-control"> 
                            </div>
                        </div>
                        <div class="form-group"><label class="col-lg-4 control-label">Pemilik</label>
                            <div class="col-lg-8"><input type="text" name="pemilik" value="{{$detail->pemilik}}" placeholder="Pemilik ..." class="form-control"> 
                            </div>
                        </div>
                        <div class="form-group"><label class="col-lg-4 control-label">Lokasi</label>
                            <div class="col-lg-8"><textarea class="form-control" name="lokasi" value="{{$detail->alamat}}" placeholder="Isi Lokasi"></textarea> 
                            </div>
                        </div>
                        <div class="form-group"><label class="col-lg-4 control-label">Tahun</label>
                            <div class="col-lg-8"><input type="text" name="tahun" value="{{$detail->tahun}}" placeholder="Tahun ..."  class="form-control"> 
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" ng-click="tambahdata()">Simpan</button>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Modal Edit Project End -->
@endsection