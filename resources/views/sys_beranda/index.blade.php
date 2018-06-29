@extends('index')

@section('library-css')
<!-- kosong -->
@endsection

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
                    <h2>Selamat datang admin<small>Anda telah login sebagai admin</small></h2>
                </div>
                <div class="body">
                    <ul>
                        <li>Untuk menambah data tekan tombol  <a href="" class="btn bg-primary btn-xs waves-effect">+ Tambah</a><br><br></li>
                        <li>Untuk mengedit data klik 2 kali pada data yang bergaris bawah seperti : <font style="border-bottom:1px dashed grey;">Contoh</font><br><br></li>
                        <li>Untuk menghapus data tekan tombol  <a d="todolink" data-toggle="modal" class="btn bg-red btn-xs waves-effect"><i class="material-icons">delete</i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="info-box-3 bg-red hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">assignment</i>
                </div>
                <div class="content">
                    <div class="text">Wisata</div>
                    <div class="number count-to" data-from="0" data-to="125" data-speed="1000" data-fresh-interval="20">125</div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="info-box-3 bg-light-green hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">assignment</i>
                </div>
                <div class="content">
                    <div class="text">Hotel</div>
                    <div class="number count-to" data-from="0" data-to="125" data-speed="1000" data-fresh-interval="20">125</div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="info-box-3 bg-blue hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">assignment</i>
                </div>
                <div class="content">
                    <div class="text">Rumah Makan</div>
                    <div class="number count-to" data-from="0" data-to="125" data-speed="1000" data-fresh-interval="20">125</div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="info-box-3 bg-orange hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">assignment</i>
                </div>
                <div class="content">
                    <div class="text">Dokumentasi</div>
                    <div class="number count-to" data-from="0" data-to="125" data-speed="1000" data-fresh-interval="20">125</div>
                </div>
            </div>
        </div>
       
    </div>
    <!-- #END# Colored Card - With Loading -->
</div>
@endsection

@section('library-js')
    <script src="{{asset('assets/js/pages/widgets/infobox/infobox-4.js')}}"></script>
@endsection

@section('js-code')

@endsection