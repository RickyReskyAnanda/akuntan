@extends('layout.app')
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