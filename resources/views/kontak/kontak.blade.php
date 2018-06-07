@extends('admin.index')

@section('content')
<div class="container-fluid">
  <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{url('administrator')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Kontak</li>
    </ol>
    <!-- Example DataTables Card-->
    @if (session('pesan'))
        <div class="alert alert-success alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            {{session('pesan')}}
        </div>
    @endif
    @if (session('gagal'))
        <div class="alert alert-danger alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            {{session('gagal')}}
        </div>
    @endif
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-table"></i> Data Kontak
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="10%"><button class="btn btn-warning btn-block" data-toggle="modal" data-target="#tambahkontak"><i class="fa fa-plus"></i> Tambah</button></th>
                            <th width="5%">No</th>
                            <th width="15%">Nama Kontak</th>
                            <th>Nomor Telpon/HP</th>
                            <th>Alamat</th>
                            <th>Transaksi</th>
                        </tr>
                    </thead>
                    <tbody><!-- isi disini -->
                        <?php $i=1;?>
                        @foreach($data as $val)
                        <?php $dataID = base64_encode(base64_encode(strval($val->id_suplier))); ?>
                        <tr>
                            <td>
                                <button class="btn btn-danger b-hapus" data-id="{{$dataID}}" data-toggle="modal" data-target="#hapuskontak"><i class="fa fa-trash"></i></button> 
                                <button class="btn btn-info b-edit" data-id="{{$dataID}}" data-toggle="modal" data-target="#editkontak"><i class="fa fa-pencil"></i></button>
                            </td>
                            <td>{{$i++}}</td>
                            <td>{{$val->name}}</td>
                            <td>{{$val->no_telp}}</td>
                            <td>{{$val->alamat}}</td>
                            <td>Rp.0,-</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="tambahkontak" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kontak</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{url('administrator/kontak/tambah')}}" method="post">
                {{csrf_field()}}
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-form-label">Nama Kontak</label>
                        <input class="form-control" type="text" name="nama_kontak" value="{{old('nama_kontak')}}" required placeholder="Masukkan nama kontak">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Nomor Telpon/HP</label>
                        <input class="form-control" type="text" name="nomor" value="{{old('nomor')}}" required placeholder="Masukkan nomor telpon/HP">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Alamat</label>
                        <textarea class="form-control" name="alamat" placeholder="Masukkan alamat kontak">{{old('alamat')}}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="editkontak" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Kontak</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{url('administrator/kontak/edit')}}" method="post">
                {{csrf_field()}}
                <input type="hidden" name="id_kontak" id="edIdKontak">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-form-label">Nama Kontak</label>
                        <input class="form-control" type="text" name="nama_kontak" id="edNamaKontak" required placeholder="Masukkan nama kontak">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Nomor Telpon/HP</label>
                        <input class="form-control" type="text" name="nomor" id="edNomorTelponKontak" required placeholder="Masukkan nomor telpon/HP">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Alamat</label>
                        <textarea class="form-control" name="alamat" id="edAlamatKontak" placeholder="Masukkan alamat kontak"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="hapuskontak" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Apakah Anda ingin menghapus data penguji?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Tekan tombol Hapus untuk hapus.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger" id="tombolHapus" href="">Hapus</a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('.b-hapus').click(function(){
        $('#tombolHapus').attr("href", "{{url('administrator/kontak/hapus.')}}"+$(this).attr('data-id'));
    });
    $('.b-edit').click(function(){
        var dataID = $(this).attr('data-id');
        $.get("{{url('administrator/kontak/edit.')}}"+dataID, function(data, status){
            $('#edIdKontak').val(dataID);       
            $('#edNamaKontak').val(data.name);       
            $('#edNomorTelponKontak').val(data.no_telp);       
            $('#edAlamatKontak').val(data.alamat);       
        });
    });
</script>
@endsection