@extends('index')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-12">
        <h2>User</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('backoffice')}}">Dashboard</a>
            </li>
            <li class="active">
                <strong>User</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahModal">
                        Tambah User
                    </button>
                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Alamat</th>
                                    <th>Level</th>
                                    <th width="25%" style="text-align: center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Alamat</th>
                                    <th>Level</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah User </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{url('api/backoffice/user/tambah')}}" method="post" enctype="multipart/form-data" class="formData">
                {{csrf_field()}}
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-form-label">Nama</label>
                        <input class="form-control" type="text" name="nama_user" placeholder="Masukkan nama user" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Nomor Telpon / HP </label>
                        <input class="form-control" name="no_telp_user" type="number" placeholder="Masukkan nomor telpon user" required>
                        <small>Ex. 08123456xxxx</small>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Alamat</label>
                        <textarea class="form-control" name="alamat" placeholder="Masukkan alamat user" required></textarea>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Level User</label>
                        <select class="form-control" name="level" required>
                            <option disabled selected value=""> --- </option>
                            <option value="admin"> Admin</option>
                            <option value="karyawan"> Karyawan </option>
                            <option value="investor"> Investor </option>
                        </select>
                    </div>
                    <hr>
                    <p>*Nomor HP/Telpon pengguna digunakan sebagai Username dan password defaultnya </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit User </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{url('api/backoffice/user/edit')}}" method="post" enctype="multipart/form-data" class="formData">
                {{csrf_field()}}
                <input type="hidden" name="user_id" id="edUserId" value="" required>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-form-label">Nama</label>
                        <input class="form-control" type="text" name="nama_user" id="edNama" placeholder="Masukkan nama user" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Nomor Telpon / HP </label>
                        <input class="form-control" name="no_telp_user" id="edTelp" type="number" placeholder="Masukkan nomor telpon user" required>
                        <small>Ex. 08123456xxxx</small>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Alamat</label>
                        <textarea class="form-control" name="alamat" id="edAlamat" placeholder="Masukkan alamat user" required></textarea>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Level User</label>
                        <select class="form-control" name="level" id="edLevel" required>
                            <option disabled value="" selected> --- </option>
                            <option value="admin">Admin</option>
                            <option value="karyawan">Karyawan</option>
                            <option value="investor">Investor</option>
                        </select>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="col-form-label">Status</label>
                        <select class="form-control" name="status" id="edStatus" required>
                            <option disabled value="" selected> --- </option>
                            <option value="0">Default</option>
                            <option value="1">Aktif</option>
                            <option value="2">Blokir</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script type="text/javascript">

        var t = $('.dataTables-example').DataTable({
            pageLength: 25,
            responsive: true,
        });

        var getDataUser = function(){
            $.ajax({
                url: "{{url('api/backoffice/user/data')}}",
                dataType: 'json',
                success: function(s){
                    t.clear().draw();
                    for(var i = 0; i < s.length; i++) { 
                      t.row.add( [
                            s[i]['name'],
                            s[i]['username'],
                            s[i]['alamat'],
                            s[i]['level'],
                            '<a class="bResetPassword" data-id="'+s[i]['user_id']+'"><i class="fa fa-pencil"></i> Reset Password</a> | '+
                            '<a class="bEditData" data-id="'+s[i]['user_id']+'" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i> Edit</a> | '+
                            '<a class="bDeleteData" data-id="'+s[i]['user_id']+'" data-toggle="modal" data-target="#hapusModal"><i class="fa fa-trash"></i> Hapus</a>'
                        ] ).draw();
                    } // End For  
                }, 
                error: function(e){ 
                    console.log(e.responseText); 
                } 
            }); 
        }
        getDataUser();


        //detail redirecting
        $(document).on('click','.detailSuplier',function(){
            var idSuplier = $(this).attr('data-id');
            window.location.href = "{{url('backoffice/suplier')}}/"+idSuplier;
        });
      
        // Automatically add a first row of data
        $(".formData").submit(function(event){

            event.preventDefault(); //prevent default action 
            var post_url = $(this).attr("action"); //get form action url
            var request_method = $(this).attr("method"); //get form GET/POST method
            var form_data = $(this).serialize(); //Encode form elements for submission
            
            $('.modal').modal('hide');

            $.ajax({
                url : post_url,
                type: request_method,
                data : form_data
            }).done(function(response){ //
                if (response == 'success')
                    getDataUser();
                else
                    alert('terjadi kesalahan');
            });
        });

    $(document).on('click','.bResetPassword',function(){
    
        var dataID = $(this).attr('data-id');
        swal({
            title: "Reset Password ?",
            text: "Password akan kembali sama dengan username!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya, Reset!",
            // cancelButtonText: "Tidak, batal!",
            closeOnConfirm: false,
            // closeOnCancel: true 
        },function () {
            $.get("{{url('api/backoffice/user/reset-password')}}/"+dataID, function(data, status){
                // console.log(status);
                if (data == "success") {
                    swal("Tereset!", "Password telah di reset!", "success");
                } else {
                    swal("Gagal", "Terjadi kesalahan!", "error");
                }
            });
        });
    });

    $(document).on('click','.bDeleteData',function(){
     var dataID = $(this).attr('data-id');
        swal({
            title: "Hapus data ?",
            text: "Data tidak dapat dikembalikan setelah di hapus!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya, Hapus!",
            // cancelButtonText: "Tidak, batal!",
            closeOnConfirm: false,
            // closeOnCancel: true 
        },function () {
            $.get("{{url('api/backoffice/user/delete')}}/"+dataID, function(data, status){
                // console.log(status);
                if (data == "success") {
                    swal("Terhapus!", "Data telah dihapus!", "success");
                } else {
                    swal("Gagal", "Terjadi kesalahan!", "error");
                }

                getDataUser();
            });
        });
    });
    $(document).on('click','.bEditData',function(){
        var dataID = $(this).attr('data-id');
        $.get("{{url('api/backoffice/user/edit')}}/"+dataID, function(data, status){
            $('#edUserId').val(data.user_id);       
            $('#edNama').val(data.name);       
            $('#edTelp').val(data.username);       
            $('#edAlamat').val(data.alamat);       
            $('#edLevel').val(data.level);       
            $('#edStatus').val(data.sts);       
        });
    });
</script>

@endsection