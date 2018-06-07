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

<div class="wrapper wrapper-content animated fadeInRight">
    <button class="btn btn-primary dim" type="button" data-toggle="modal" data-target="#myModal" ng-click="viewtambah()"><i class="fa fa-money"></i> | Tambah Project baru</button>
    
        
    @foreach($proyek as $val)
    <?php $proyekId = base64_encode(base64_encode(strval($val->id_proyek))); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    @if($val->status == "berjalan")
                    <button class="btn btn-primary btn-sm pull-right" proyek-id="{{$proyekId}}">
                        <i class="fa fa-check"></i>&nbsp;| Belum Selesai
                    </button>
                    @else
                    <button class="btn btn-primary btn-sm pull-right" proyek-id="{{$proyekId}}">
                        <i class="fa fa-check"></i>&nbsp;| Selesai
                    </button>
                    @endif
                    <button class="btn btn-danger btn-sm pull-right" proyek-id="{{$proyekId}}" style="margin: 0px 7px;"><i class="fa fa-trash"></i>&nbsp;| Hapus Project</button>

                    <a href="{{url('backoffice/proyek/detail/'.base64_encode(base64_encode(strval($val->id_proyek))))}}" class="btn btn-info btn-sm pull-right" ><i class="fa fa-eye"></i>&nbsp;| Detail</a>

                    <h2><b>{{$val->nama_proyek}}</b></h2>
                </div>
                <div class="ibox-content">
                    <div class="m-t-sm">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="dl-vertical">
                                    <div class="badge badge-info"><i class="fa fa-user"></i> Pemilik Project </div>
                                    <div style="margin: 5px 18px;">{{$val->pemilik}}</div><hr>
                                    <div class="badge badge-info"><i class="fa fa-map-marker"></i> Lokasi </div>
                                    <div style="margin: 5px 18px;">{{$val->lokasi}}</div><hr>
                                    <div class="badge badge-info"><i class="fa fa-calendar"></i> Tahun </div>
                                    <div style="margin: 5px 18px;">{{$val->tahun}}</div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <ul class="stat-list">
                                    <div class="col-md-4"> <span class="badge badge-warning">DEBIT</span>
                                        <ul class="stat-list">
                                        <li class="col-md-12">
                                            <h2 class="no-margins" >Rp. {{number_format($val->debit)}}</h2>
                                            <div class="progress progress-mini">
                                                <div class="progress-bar" style="width: 100%;"></div>
                                            </div>
                                        </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4"> <span class="badge badge-warning">KREDIT</span>
                                        <ul class="stat-list">
                                        <li class="col-md-12">
                                            <h2 class="no-margins" >Rp. {{number_format($val->kredit)}}</h2>
                                            <div class="progress progress-mini">
                                                <div class="progress-bar" style="width: 100%;"></div>
                                            </div>
                                        </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4"> <span class="badge badge-warning">SALDO</span>
                                        <ul class="stat-list">
                                        <li class="col-md-12">
                                            <h2 class="no-margins" >Rp. {{number_format($val->saldo)}}</h2>
                                            <div class="progress progress-mini">
                                                <div class="progress-bar" style="width: 100%;"></div>
                                            </div>
                                        </li>
                                        </ul>
                                    </div>
                                </ul>
                            </div>
                        </div>
                        <div class="m-t-md">
                            <small class="pull-right">
                                <i class="fa fa-clock-o"> </i>
                                Terakhir diubah 16.07.2015
                            </small>
                            <small>
                                <i class="fa fa-calendar-o"></i> Selasa, 1 November 2016 - Rabu, 30 November 2016
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

</div>

<div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="fa fa-folder modal-icon"></i>
                <h4 class="modal-title">Tambah Proyek</h4>
            </div>
            <form class="form-horizontal" method="post" action="{{url('backoffice/proyek/tambah')}}">
                {{csrf_field()}}
                <div class="modal-body">
                    <div class="form-group"><label class="col-lg-4 control-label">Nama Proyek</label>
                        <div class="col-lg-8"><input type="text" name="nama_proyek" placeholder="Nama Project ..." class="form-control"> 
                        </div>
                    </div>
                    <div class="form-group"><label class="col-lg-4 control-label">Pemilik</label>
                        <div class="col-lg-8"><input type="text" name="pemilik" placeholder="Pemilik ..." class="form-control"> 
                        </div>
                    </div>
                    <div class="form-group"><label class="col-lg-4 control-label">Lokasi</label>
                        <div class="col-lg-8"><textarea class="form-control" name="lokasi" placeholder="Isi Lokasi"></textarea> 
                        </div>
                    </div>
                    <div class="form-group"><label class="col-lg-4 control-label">Tahun</label>
                        <div class="col-lg-8"><input type="number" min="1900" max="3000" name="tahun" placeholder="Tahun ..."  class="form-control"> 
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

@endsection