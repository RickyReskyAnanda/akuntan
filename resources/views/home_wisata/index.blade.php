@extends('index')
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
                    <h2>Bukti Pendukung</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th rowspan="3">No</th>
                                    <th rowspan="3">Kode & Nama Sub Kegiatan</th>
                                    <th colspan="36">Bukti Menurut Bulan</th>
                                    <th rowspan="3">#</th>
                                </tr>
                                <tr>
                                    @for($i=1; $i<=12;$i++)
                                    <th colspan="3">B<?php if(strlen($i)==1)echo "0";echo $i?></th>
                                    @endfor
                                </tr>
                                <tr>
                                    @for($i=0; $i < 12; $i++)
                                    <th>Video</th>
                                    <th>Dokumen</th>
                                    <th>Foto</th>
                                    @endfor
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>               

                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Colored Card - With Loading -->
</div>
@endsection

@section('library-css')
<!-- JQuery DataTable Css -->
<link href="{{asset('assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
 <!-- Bootstrap Select Css -->
<link href="{{asset('assets/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />
@endsection

@section('library-js')
 <!-- Jquery DataTable Plugin Js -->
    <script src="{{asset('assets/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
    <script src="{{asset('assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
    <!-- <script src="{{asset('assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}"></script> -->
    <!-- <script src="{{asset('assets/plugins/jquery-datatable/extensions/export/buttons.flash.min.js')}}"></script>
    <script src="{{asset('assets/plugins/jquery-datatable/extensions/export/jszip.min.js')}}"></script>
    <script src="{{asset('assets/plugins/jquery-datatable/extensions/export/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/plugins/jquery-datatable/extensions/export/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/plugins/jquery-datatable/extensions/export/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/plugins/jquery-datatable/extensions/export/buttons.print.min.js')}}"></script> -->

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
    // var getDataUser = function(){
    //     $.ajax({
    //         url: "{{url('api/admin/user')}}",
    //         dataType: 'json',
    //         success: function(s){
    //             t.clear().draw();
    //             for(var i = 0; i < s.length; i++) { 
    //                 addDataUser(s[i]);
    //             } // End For  
    //         }, 
    //         error: function(e){ 
    //             console.log(e.responseText); 
    //         } 
    //     }); 
    // }
    // getDataUser();


    // var addDataUser = function(data){
    //     t.row.add( [
    //         '<a class="bResetPassword" data-id="'+data['id']+'"><i class="fa fa-pencil"></i> Reset Password</a> | '+
    //         '<a class="bEditData" data-id="'+data['id']+'" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i> Edit</a> | '+
    //         '<a class="bDeleteData" data-id="'+data['id']+'" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i> Hapus</a>',
    //         data['name'],
    //         data['username'],
    //         data['level'],
    //         data['status']
    //     ] ).draw();
    // }

    // //     //detail redirecting
    // //     $(document).on('click','.detailSuplier',function(){
    // //         var idSuplier = $(this).attr('data-id');
    // //         window.location.href = "{{url('backoffice/suplier')}}/"+idSuplier;
    // //     });
      
    //     // Automatically add a first row of data
    // $(".formData").submit(function(event){

    //     event.preventDefault(); //prevent default action 
    //     var post_url = $(this).attr("action"); //get form action url
    //     var request_method = $(this).attr("method"); //get form GET/POST method
    //     var form_data = $(this).serialize(); //Encode form elements for submission
        
    //     $('.modal').modal('hide');

    //     $.ajax({
    //         url : post_url,
    //         type: request_method,
    //         data : form_data
    //     }).done(function(response){ //
    //         if (response != 'error'){
    //             addDataUser(response);
    //             swal("Berhasil!", "Data telah disimpan!", "success");
    //         }else
    //             swal("Gagal!", "Terjadi Kesalahan!", "error");
    //     });
    // });

    // // $(document).on('click','.bResetPassword',function(){
    
    // //     var dataID = $(this).attr('data-id');
    // //     swal({
    // //         title: "Reset Password ?",
    // //         text: "Password akan kembali sama dengan username!",
    // //         type: "warning",
    // //         showCancelButton: true,
    // //         confirmButtonColor: "#DD6B55",
    // //         confirmButtonText: "Ya, Reset!",
    // //         // cancelButtonText: "Tidak, batal!",
    // //         closeOnConfirm: false,
    // //         // closeOnCancel: true 
    // //     },function () {
    // //         $.get("{{url('api/backoffice/user/reset-password')}}/"+dataID, function(data, status){
    // //             // console.log(status);
    // //             if (data == "success") {
    // //                 swal("Tereset!", "Password telah di reset!", "success");
    // //             } else {
    // //                 swal("Gagal", "Terjadi kesalahan!", "error");
    // //             }
    // //         });
    // //     });
    // // });

    // // $(document).on('click','.bDeleteData',function(){
    // //  var dataID = $(this).attr('data-id');
    // //     swal({
    // //         title: "Hapus data ?",
    // //         text: "Data tidak dapat dikembalikan setelah di hapus!",
    // //         type: "warning",
    // //         showCancelButton: true,
    // //         confirmButtonColor: "#DD6B55",
    // //         confirmButtonText: "Ya, Hapus!",
    // //         // cancelButtonText: "Tidak, batal!",
    // //         closeOnConfirm: false,
    // //         // closeOnCancel: true 
    // //     },function () {
    // //         $.get("{{url('api/backoffice/user/delete')}}/"+dataID, function(data, status){
    // //             // console.log(status);
    // //             if (data == "success") {
    // //                 swal("Terhapus!", "Data telah dihapus!", "success");
    // //             } else {
    // //                 swal("Gagal", "Terjadi kesalahan!", "error");
    // //             }

    // //             getDataUser();
    // //         });
    // //     });
    // // });
    // $(document).on('click','.bEditData',function(){
    //     var dataID = $(this).attr('data-id');
    //     $.get("{{url('api/admin/user')}}/"+dataID, function(data, status){
    //         $('#edId').val(data.id);       
    //         $('#edName').val(data.name);       
    //         $('#edUsername').val(data.alamat);       
    //         $('#edLevel').val(data.level);       
    //     });
    // });
</script>
@endsection