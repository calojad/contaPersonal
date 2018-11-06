@extends('layouts.app')
@section('content')
    <div class="row">
        @include('includes.notificacion')
        <div class="col-md-12">
            <div class="box box-principal">
                <div class="box-header">
                    <h3 class="box-title">Perfil</h3>
                </div>
                <div class="box-body">
                    <div class="col-md-4 col-md-pull-1">
                        <div class="col-md-12 show-grid">
                            <img class="profile-user-img img-responsive img-circle" src="{{ asset('images/CAL_logo.png') }}" alt="User profile picture">
                        </div>
                        <div class="col-md-12">
                            <dl class="dl-horizontal">
                                <dt>Nombre</dt>
                                <dd>{{$user->name}}</dd>
                                <dt>Username</dt>
                                <dd>{{$user->username}}</dd>
                                <dt>Email</dt>
                                <dd>{{$user->email}}</dd>
                            </dl>
                        </div>
                        <a class="btn btn-xs btn-primary col-md-push-1" href="#"><i class="fa fa-edit"></i></a>
                    </div>
                </div>
                <div class="box-footer">
                    
                </div>
            </div>
        </div>
    </div>
@endsection