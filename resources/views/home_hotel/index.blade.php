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
                    <h2>
                        Entri Data
                    </h2>
                </div>
                <div class="body">
                    <p><b>Program</b></p>
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <select class="form-control" name="program" id="edProgram" required>
                                <option value="" disable selected> -- Pilih Program -- </option>

                                <option value=""></option>
                            </select>
                        </div>
                    </div>

                    <p><b>Kegiatan</b></p>
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="form-line">
                                    <select class="form-control" name="kegiatan" required="">
                                        <option value="" disable selected> -- Pilih Kegiatan -- </option>
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <p><b>Sub Kegiatan</b></p>
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="form-line">
                                    <select class="form-control" name="subkegiatan" required="">
                                        <option value="" disable selected> -- Pilih Sub Kegiatan -- </option>
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($waktu == 'bulan')
                    <p><b>Bulan</b></p>
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="form-line">
                                    <select class="form-control" name="waktu" required="">
                                        <option value="" disable selected> -- Pilih Bulan -- </option>
                                        <option value="">[B01] Januari</option>
                                        <option value="">[B02] Februari</option>
                                        <option value="">[B03] Maret</option>
                                        <option value="">[B04] April</option>
                                        <option value="">[B05] Mei</option>
                                        <option value="">[B06] Juni</option>
                                        <option value="">[B07] Juli</option>
                                        <option value="">[B08] Agustus</option>
                                        <option value="">[B09] September</option>
                                        <option value="">[B10] Oktober</option>
                                        <option value="">[B11] November</option>
                                        <option value="">[B12] Desember</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <p><b>Triwulan</b></p>
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="form-line">
                                    <select class="form-control" name="waktu" required="">
                                        <option value="" disable selected> -- Pilih Triwulan-- </option>
                                        <option value="1">Triwulan I</option>
                                        <option value="2">Triwulan II</option>
                                        <option value="3">Triwulan III</option>
                                        <option value="4">Triwulan IV</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                </div>
            </div>
            <div class="card">
                <div class="header bg-red">
                    <h2>Pratinjau Laporan</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th rowspan="3">No</th>
                                    <th rowspan="3">Kode & Nama Sub Kegiatan</th>
                                    <th colspan="6">Bulan Januari</th>
                                </tr>
                                <tr>
                                    <th colspan="2">Anggaran</th>
                                    <th colspan="2">Fisik</th>
                                    <th rowspan="2">Kinerja Total</th>
                                    <th rowspan="2">Status Pelaksanaan</th>
                                </tr>
                                <tr>
                                    <th>Realisasi</th>
                                    <th>Kinerja</th>
                                    <th>Realisasi</th>
                                    <th>Kinerja</th>
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