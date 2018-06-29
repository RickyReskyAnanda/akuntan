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
                    <h2>Pratinjau Laporan</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th rowspan="4">No</th>
                                    <th rowspan="4">Kode & Nama Sub Kegiatan</th>
                                    <th colspan="48">Pratinjau Laporan Menurut Bulan</th>
                                    <th rowspan="4">#</th>
                                </tr>
                                <tr>
                                    @for($i=1; $i<=12;$i++)
                                    <th colspan="6">B<?php if(strlen($i)==1)echo "0";echo $i?></th>
                                    @endfor
                                </tr>
                                <tr>
                                    @for($i=0; $i < 12; $i++)
                                    <th colspan="2">Anggaran</th>
                                    <th colspan="2">Fisik</th>
                                    <th rowspan="2">Kinerja Total</th>
                                    <th rowspan="2">Status Pelaksanaan</th>
                                    @endfor
                                </tr>
                                <tr>
                                    @for($i=0; $i < 12; $i++)
                                    <th>Realisasi</th>
                                    <th>Kinerja</th>
                                    <th>Realisasi</th>
                                    <th>Kinerja</th>
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

</script>
@endsection