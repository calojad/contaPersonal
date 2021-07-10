@extends('layouts.app')
@section('styles')
    <!-- Styles -->
    <style>
        .flayer-1 {
            position: relative;
            z-index: 5;
            font-size: 400%;
            padding: 20px;
        }
    </style>
    <!-- Custom styles for this template -->
    {!! Html::style('/css/custom-animations.css') !!}
    {!! Html::style('/css/style.css') !!}
@endsection
@section('content')
    @include('includes.notificacion')
    <div id="h">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 flayer-1">
                <h3 style="color: #1f1f1f">Administra tu dinero de manera inteligente</h3>
                <h1 class="mb" style="color: #1f1f1f;font-size: 8vw;">FINANZAS PERSONALES</h1>
            </div>
        </div>
    </div>
    <div id="w">
        <div class="row nopadding">
            <div class="col-md-5 col-md-offset-1 mt">
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown
                    printer took a galley of type and scrambled it to make a type specimen book.
                    It has survived not only five centuries, but also the leap into electronic typesetting, remaining
                    essentially unchanged.
                </p>
            </div>
            <div class="col-md-6 pull-right">
                <img src="{{asset('images/finanzas_ahorro.jpg')}}" class="img-responsive alignright" alt=""
                     data-effect="slide-right">
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    {!! Html::script('/js/retina-1.1.0.js') !!}
    {!! Html::script('/js/jquery.unveilEffects.js') !!}
@endsection