@extends('index')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-12">
        <h2>{{$detail->name}}</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('backoffice')}}">Dashboard</a>
            </li>
            <li>
                <a href="{{url('backoffice/suplier')}}">Suplier</a>
            </li>
            <li class="active">
                <strong>{{$detail->name}}</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox" id="ibox1">
		        <div class="ibox-content">
		            <div class="row">
		                <div class="col-lg-12">
		                    <div class="m-b-md">
		                        <a class="btn btn-warning btn-sm pull-right" type="button" data-toggle="modal" data-target="#editProject"><i class="fa fa-edit"></i> | Edit Project</a>
		                        <h2>{{$detail->name}}</h2>
		                    </div>
		                </div>
		            </div>
		            <div class="row" style="margin-bottom:20px;">
		                <div class="col-lg-4">
		                    <dl class="dl-vertical">
		                        <dt class="badge badge-info"><i class="fa fa-user"></i> Pemilik Project </dt>
		                        <dd style="margin: 5px 18px;">{{$detail->no_telp}}</dd><hr>
		                        <dt class="badge badge-info"><i class="fa fa-map-marker"></i> Lokasi </dt>
		                        <dd style="margin: 5px 18px;">{{$detail->merk}}</dd><hr>
		                        <dt class="badge badge-info"><i class="fa fa-calendar"></i> Status </dt>
		                        <dd style="margin: 5px 18px;">{{$detail->alamat}}</dd>
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
		</div>
	</div>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    Proyek Terhubung
                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th>Nama Proyek</th>
                                    <th>Pemilik</th>
                                    <th>Lokasi</th>
                                    <th>Tahun</th>
                                    <th>Nomor Telpon</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nama Proyek</th>
                                    <th>Pemilik</th>
                                    <th>Lokasi</th>
                                    <th>Tahun</th>
                                    <th>Nomor Telpon</th>
                                    <th>Status</th>
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

<script type="text/javascript">
		var idSuplier = "{{encConvId($detail->id_suplier)}}";

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

        var getDataProyek = function(){
            $.ajax({
                url: "{{url('api/backoffice/suplier/detail/data')}}/"+idSuplier,
                dataType: 'json',
                success: function(s){
                    t.clear().draw();
                    for(var i = 0; i < s.length; i++) { 
                      t.row.add( [
                            s[i]['nama_proyek'],
                            s[i]['pemilik'],
                            s[i]['lokasi'],
                            s[i]['tahun'],
                            s[i]['no_telp'],
                            s[i]['status'],
                            '<a href="javascript:;" class="detailProyek" data-id="'+s[i]['proyek_id']+'"><i class="fa fa-pencil"></i> Detail</a>'
                        ] ).draw();
                    } // End For  
                }, 
                error: function(e){ 
                    console.log(e.responseText); 
                } 
            }); 
        }
        getDataProyek();


        //detail redirecting
        $(document).on('click','.detailProyek',function(){
            var idProyek = $(this).attr('data-id');
            window.location.href = "{{url('backoffice/suplier/proyek')}}/"+idSuplier+"/"+idProyek;
        });
</script>

@endsection