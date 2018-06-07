@extends('index')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-12">
        <h2>Suplier</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('backoffice')}}">Dashboard</a>
            </li>
            <li class="active">
                <strong>Suplier</strong>
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
                        Tambah Suplier
                    </button>
                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th>Nama Suplier</th>
                                    <th>No. telp</th>
                                    <th>Alamat</th>
                                    <th>Merk</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nama Suplier</th>
                                    <th>No. telp</th>
                                    <th>Alamat</th>
                                    <th>Merk</th>
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

<div class="modal inmodal" id="tambahModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">  
        <div class="modal-content animated bounceIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="fa fa-user modal-icon"></i>
                <h4 class="modal-title">Tambah Suplier</h4>
            </div>
            <form class="form-horizontal" method="post" action="{{url('api/backoffice/suplier/tambah')}}" id="tambahSuplier">
                {{csrf_field()}}
                <div class="modal-body">
                    <div class="form-group"><label class="col-lg-4 control-label">Nama Suplier*</label>
                        <div class="col-lg-8"><input type="text" name="nama_suplier" placeholder="Masukkan nama suplier..." class="form-control" required> 
                        </div>
                    </div>
                    <div class="form-group"><label class="col-lg-4 control-label">No. Telepon*</label>
                        <div class="col-lg-8"><input type="number" name="no_telp" placeholder="Masukkan nomor telepon..." class="form-control" required> 
                        </div>
                    </div>
                    <div class="form-group"><label class="col-lg-4 control-label">Alamat*</label>
                        <div class="col-lg-8"><textarea class="form-control" name="alamat" rows="3" placeholder="Masukkan alamat..." required></textarea>
                        </div>
                    </div>
                    <div class="form-group"><label class="col-lg-4 control-label">Merk</label>
                        <div class="col-lg-8"><input type="text" name="merk" placeholder="Masukkan nama pemilik..." class="form-control"> 
                        </div>
                    </div>
                    <small>(*) Wajib</small>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">

        var t = $('.dataTables-example').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                {   extend: 'pdf', 
                    title: 'ExampleFile',   
                    exportOptions: {
                        columns: [ 0, 1 ]
                    }
                },

                {extend: 'print',
                 customize: function (win){
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                }
                }
            ]
        });

        var getDataSuplier = function(){
            $.ajax({
                url: "{{url('api/backoffice/suplier/data')}}",
                dataType: 'json',
                success: function(s){
                    t.clear().draw();
                    for(var i = 0; i < s.length; i++) { 
                      t.row.add( [
                            s[i]['name'],
                            s[i]['no_telp'],
                            s[i]['alamat'],
                            s[i]['merk'],
                            '<a href="javascript:;" class="detailSuplier" data-id="'+s[i]['id']+'"><i class="fa fa-pencil"></i> Detail</a> | '+
                            '<a data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i> Edit</a> | '+
                            '<a data-toggle="modal" data-target="#hapusModal"><i class="fa fa-trash"></i> Hapus</a>'
                        ] ).draw();
                    } // End For  
                }, 
                error: function(e){ 
                    console.log(e.responseText); 
                } 
            }); 
        }
        getDataSuplier();


        //detail redirecting
        $(document).on('click','.detailSuplier',function(){
            var idSuplier = $(this).attr('data-id');
            window.location.href = "{{url('backoffice/suplier')}}/"+idSuplier;
        });
      
        // Automatically add a first row of data
         $("#tambahSuplier").submit(function(event){

            event.preventDefault(); //prevent default action 
            var post_url = $(this).attr("action"); //get form action url
            var request_method = $(this).attr("method"); //get form GET/POST method
            var form_data = $(this).serialize(); //Encode form elements for submission
            
            $('#tambahModal').modal('hide');

            $.ajax({
                url : post_url,
                type: request_method,
                data : form_data
            }).done(function(response){ //
                t.row.add( [
                    response['name'],
                    response['name'],
                    response['name'],
                    response['name'],
                    '<a href=""><i class="fa fa-pencil"></i> Detail</a> | '+
                    '<a data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i> Edit</a> | '+
                    '<a data-toggle="modal" data-target="#hapusModal"><i class="fa fa-trash"></i> Hapus</a>'
                ] ).draw();
     
                counter++;
                
            });
        });

// <tr class="gradeX">
//                                     <td>$i++</td>
//                                     <td>ucwords($val->name)</td>
//                                     <td>$val->no_telp</td>
//                                     <td class="center">$val->alamat</td>
//                                     <td class="center">$val->merk</td>
//                                     <td class="center">
//                                         <button class="btn btn-primary" data-id="$dataId" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i> Edit</button>
//                                         if(count($val->getProyek) < 1 )
//                                         <button class="btn btn-danger" data-id="$dataId" data-toggle="modal" data-target="#hapusModal"><i class="fa fa-trash"></i> Hapus</button>
//                                         endif
//                                     </td>
//                                 </tr>










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