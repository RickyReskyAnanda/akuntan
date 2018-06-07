@extends('index')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-12">
        <h2>Akun</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('backoffice')}}">Dashboard</a>
            </li>
            <li class="active">
                <strong>Akun</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Basic form <small>Simple login form example</small></h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-6 b-r"><h3 class="m-t-none m-b">Sign in</h3>
                            <p>Sign in today for more expirience.</p>
                            <form role="form">
                                <div class="form-group"><label>Email</label> <input type="email" placeholder="Enter email" class="form-control"></div>
                                <div class="form-group"><label>Password</label> <input type="password" placeholder="Password" class="form-control"></div>
                                <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Log in</strong></button>
                            </form>
                        </div>
                        <div class="col-sm-6"><h4>Not a member?</h4>
                            <p>You can create an account:</p>
                            <p class="text-center">
                                <a href=""><i class="fa fa-sign-in big-icon"></i></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Basic form <small>Simple login form example</small></h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-6 b-r"><h3 class="m-t-none m-b">Sign in</h3>
                            <p>Sign in today for more expirience.</p>
                            <form role="form">
                                <div class="form-group"><label>Email</label> <input type="email" placeholder="Enter email" class="form-control"></div>
                                <div class="form-group"><label>Password</label> <input type="password" placeholder="Password" class="form-control"></div>
                                    <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Log in</strong></button>
                            </form>
                        </div>
                        <div class="col-sm-6"><h4>Not a member?</h4>
                            <p>You can create an account:</p>
                            <p class="text-center">
                                <a href=""><i class="fa fa-sign-in big-icon"></i></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection