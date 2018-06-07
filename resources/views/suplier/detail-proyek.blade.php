@extends('index')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-12">
        <h2>{{$proyek->nama_proyek}}</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('backoffice')}}">Dashboard</a>
            </li>
            <li>
                <a href="{{url('backoffice/suplier')}}">Suplier</a>
            </li>
            <li>
                <a href="{{url('backoffice/suplier/'.encConvId($suplier->id_suplier))}}">{{$suplier->name}}</a>
            </li>
            <li class="active">
                <strong>{{$proyek->nama_proyek}}</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInUp">
    <div class="ibox">
        <div class="ibox-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="m-b-md">
                        <a href="{{url('backoffice/proyek/detail/'.encConvId($proyek->id_proyek))}}" class="btn btn-white btn-xs pull-right">Lihat Proyek</a>
                        <h2>{{$proyek->nama_proyek}}</h2>
                    </div>
                    <dl class="dl-horizontal">
                        <dt>Pemilik:</dt> <dd>{{$proyek->pemilik}}</dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt>Lokasi:</dt> <dd>{{$proyek->lokasi}}</dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt>Tahun:</dt> <dd>{{$proyek->tahun}}</dd>
                    </dl>

                        </tbody>
                    </table>
                    <dl class="dl-horizontal">
                        <dt>Status:</dt> <dd>{{ucfirst($proyek->status)}}</dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt>Pembelian:</dt> <dd>{{$proyek->pembelian}}</dd>
                    </dl>

                </div>
            </div>
            
            <div class="row m-t-sm">
                <div class="col-lg-12">
                    <div class="panel blank-panel">
                        <div class="panel-heading">
                            <h4>Jurnal Umum</h4>
                        </div>

                        <div class="panel-body">
                            <table class="table table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Uraian</th>
                                        <th>Volume</th>
                                        <th>Satuan</th>
                                        <th>Harga Satuan</th>
                                        <th>Harga Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Uraian</th>
                                        <th>Volume</th>
                                        <th>Satuan</th>
                                        <th>Harga Satuan</th>
                                        <th>Harga Total</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
        var idSuplier = "{{encConvId($suplier->id_suplier)}}";
		var idProyek = "{{encConvId($proyek->id_proyek)}}";

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

        var getDataJurnal = function(){
            $.ajax({
                url: "{{url('api/backoffice/suplier/proyek/data')}}/"+idSuplier+"/"+idProyek,
                dataType: 'json',
                success: function(s){
                    t.clear().draw();
                    for(var i = 0; i < s.length; i++) { 
                      t.row.add( [
                            s[i]['tanggal'],
                            s[i]['uraian'],
                            s[i]['volume'],
                            s[i]['satuan'],
                            s[i]['harsat'],
                            s[i]['hartot'],
                        ] ).draw();
                    } // End For  
                }, 
                error: function(e){ 
                    console.log(e.responseText); 
                } 
            }); 
        }
        getDataJurnal();
</script>

@endsection