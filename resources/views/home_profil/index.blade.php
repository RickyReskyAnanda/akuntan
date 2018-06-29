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
                    <h2>Laporan Rincian Permasalahan</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th rowspan="2">No</th>
                                    <th rowspan="2">Kode & Nama Sub Kegiatan</th>
                                    <th colspan="12">Permasalahan Menurut Bulan</th>
                                    <th rowspan="2">#</th>
                                </tr>
                                <tr>
                                    <th>B01</th>
                                    <th>B02</th>
                                    <th>B03</th>
                                    <th>B04</th>
                                    <th>B05</th>
                                    <th>B06</th>
                                    <th>B07</th>
                                    <th>B08</th>
                                    <th>B09</th>
                                    <th>B10</th>
                                    <th>B11</th>
                                    <th>B12</th>
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