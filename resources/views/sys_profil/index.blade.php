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
                        Profil User
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

                    <p><b>Bulan</b></p>
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="form-line">
                                    <select class="form-control" name="bulan" required="">
                                        <option value="" disable selected> -- Pilih Sub Kegiatan -- </option>
                                        <option value="">[B01] Januari</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="card">
                <div class="header">
                    <h2>Realisasi Fisik</h2>
                </div>
                <div class="body">
                    <p><b>Target ( % )</b></p>
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" class="form-control" name="rf_target" placeholder="Username" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <p><b>Realisasi ( % )</b></p>
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" class="form-control" name="rf_realisasi" placeholder="Username" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="header">
                    <h2>Realisasi Anggaran</h2>
                </div>
                <div class="body">

                    <p><b>Target ( % )</b></p>
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" class="form-control" name="ra_target" placeholder="Username" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <p><b>Realisasi ( % )</b></p>
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" class="form-control" name="ra_realisasi" placeholder="Username" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="header">
                    <h2>Permasalahan</h2>
                </div>
                <div class="body">
                    <p><b>Keterangan</b></p>
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="form-line">
                                    <textarea class="form-control" name=""></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="header">
                    <h2>Bukti Pendukung</h2>
                </div>
                <div class="body">

                    <p><b>Dokumen [URL]</b></p>
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="url" class="form-control" placeholder="Username" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <p><b>Video [URL]</b></p>
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="url" class="form-control" placeholder="Username" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <p><b>Gambar [URL]</b></p>
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="url" class="form-control" placeholder="Username" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <!-- #END# Input -->
</div>

@endsection

@section('library-css')
<!-- Bootstrap Select Css -->
    <link href="{{ asset('assets/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
@endsection


@section('library-js')

    <!-- Select Plugin Js -->
    <script src="{{ asset('assets/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>


    <!-- Jquery Validation Plugin Css -->
    <script src="{{ asset('assets/js/pages/forms/form-validation.js') }}"></script>
@endsection

@section('js-code')
<script type="text/javascript">
     $(document).on('change','#edProgram',function(){
        var program = $(this).val();
        $.get("{{url('api/kegiatan?program=')}}"+dataID, function(data, status){
            console.log('a');
        });
    });

</script>

@endsection