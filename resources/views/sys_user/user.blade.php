@extends('index')

@section('library-css')
<!-- JQuery DataTable Css -->
<link href="{{asset('assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
 <!-- Bootstrap Select Css -->
<link href="{{asset('assets/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />
@endsection

@section('content')
<div class="container-fluid">
    <!-- <div class="block-header">
        <h2>COLORED CARDS</h2>
    </div> -->
    <!-- Basic Example -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
            <div class="header bg-red">
                <h2>Data User</h2>
            </div>
            <div class="body">
                <button class="btn bg-primary btn-lg waves-effect" data-toggle="modal" data-target="#addModal">+ Tambah</button><br><br>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Level</th>
                                <th>Status Aktif</th>
                            </tr>
                        </thead>
                       <!--  <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Level</th>
                                <th>Status Aktif</th>
                            </tr>
                        </tfoot> -->
                        <tbody>
                            
                        </tbody>
                    </table><!-- data table -->                 
                </div>
            </div>
        </div>
        </div>
    </div>
    <!-- #END# Colored Card - With Loading -->
</div>

<!-- Add -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">Tambah Data</h4>
            </div>
            <form id="form_validation" method="POST" action="{{url('api/admin/user')}}" class="formData">
                {{csrf_field()}}
                <div class="modal-body clearfix">
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="name" required>
                            <label class="form-label">Name</label>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="username" required>
                            <label class="form-label">Username</label>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <select class="form-control show-tick" name="level" required="">
                            <option value="">-- Please select --</option>
                            <option value="admin">Admin</option>
                            <option value="satker">Satuan kerja</option>
                            <option value="kasubag">Satuan kerja</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-linkprimary waves-effect">SAVE CHANGES</button>
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Add -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">Edit Data</h4>
            </div>
            <form id="form_validation" method="PUT" action="{{url('api/admin/user')}}" class="formData">
                {{csrf_field()}}
                <input type="hidden" name="id" value="" id="edId" required>
                <div class="modal-body clearfix">
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="name" id="edName" required>
                            <label class="form-label">Name</label>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="username" id="edUsername" required>
                            <label class="form-label">Username</label>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <select class="form-control show-tick" name="level" id="edLevel" required>
                            <option value="">-- Please select --</option>
                            <option value="admin">Admin</option>
                            <option value="satker">Satuan kerja</option>
                            <option value="mondalev">Mondalev</option>
                            <option value="kasubbid">Kasubbid</option>
                            <option value="penyelia">Penyelia</option>
                            <option value="kasubbag">Kasubbag</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-linkprimary waves-effect">SAVE CHANGES</button>
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('library-js')
 <!-- Jquery DataTable Plugin Js -->
    <script src="{{asset('assets/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
    <script src="{{asset('assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>

    <!-- Jquery Validation Plugin Css -->
    <script src="{{asset('assets/js/pages/forms/form-validation.js')}}"></script>

    <!-- Select Plugin Js -->
    <script src="{{asset('assets/plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>

@endsection

@section('js-code')
<script type="text/javascript">

    var t = $('.js-basic-example').DataTable({
        pageLength: 25,
        responsive: true
    });
    var getDataUser = function(){
        $.ajax({
            url: "{{url('api/admin/user')}}",
            dataType: 'json',
            success: function(s){
                t.clear().draw();
                for(var i = 0; i < s.length; i++) { 
                    addDataUser(s[i]);
                } // End For  
            }, 
            error: function(e){ 
                console.log(e.responseText); 
            } 
        }); 
    }
    getDataUser();


    var addDataUser = function(data){
        t.row.add( [
            '<a class="bResetPassword" data-id="'+data['id']+'"><i class="fa fa-pencil"></i> Reset Password</a> | '+
            '<a class="bEditData" data-id="'+data['id']+'" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i> Edit</a> | '+
            '<a class="bDeleteData" data-id="'+data['id']+'" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i> Hapus</a>',
            data['name'],
            data['username'],
            data['level'],
            data['status']
        ] ).draw();
    }

    //     //detail redirecting
    //     $(document).on('click','.detailSuplier',function(){
    //         var idSuplier = $(this).attr('data-id');
    //         window.location.href = "{{url('backoffice/suplier')}}/"+idSuplier;
    //     });
      
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
            if (response != 'error'){
                getDataUser();
                swal("Berhasil!", "Data telah disimpan!", "success");
            }else
                swal("Gagal!", "Terjadi Kesalahan!", "error");
        }).error(function(response){
            swal("Gagal!", "Terjadi Kesalahan!", "error");

        });
    });

    // $(document).on('click','.bResetPassword',function(){
    
    //     var dataID = $(this).attr('data-id');
    //     swal({
    //         title: "Reset Password ?",
    //         text: "Password akan kembali sama dengan username!",
    //         type: "warning",
    //         showCancelButton: true,
    //         confirmButtonColor: "#DD6B55",
    //         confirmButtonText: "Ya, Reset!",
    //         // cancelButtonText: "Tidak, batal!",
    //         closeOnConfirm: false,
    //         // closeOnCancel: true 
    //     },function () {
    //         $.get("{{url('api/backoffice/user/reset-password')}}/"+dataID, function(data, status){
    //             // console.log(status);
    //             if (data == "success") {
    //                 swal("Tereset!", "Password telah di reset!", "success");
    //             } else {
    //                 swal("Gagal", "Terjadi kesalahan!", "error");
    //             }
    //         });
    //     });
    // });

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
            $.ajax({
                url : "{{url('api/admin/user')}}/"+dataID,
                type: 'DELETE',
                data : {'_token':"<?=csrf_token();?>" }

            }).done(function(response){ //
                if (response == "success")
                    swal("Terhapus!", "Data telah dihapus!", "success");
                else
                    swal("Gagal", "Terjadi kesalahan!", "error");
                getDataUser();
            }).error(function(response){
                swal("Gagal!", "Terjadi Kesalahan!", "error");
            });
        });
    });
    $(document).on('click','.bEditData',function(){
        var dataID = $(this).attr('data-id');
        $.get("{{url('api/admin/user')}}/"+dataID, function(data, status){
            $('#edId').val(data.id);       
            $('#edName').val(data.name);       
            $('#edUsername').val(data.username);       
            $('#edLevel').val(data.level);       
        });
    });
</script>
@endsection