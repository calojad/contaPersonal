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
                <p class="text-black">
                    Estimados hermanos y hermanas:<br/>
                    El Señor declaró: “… es mi propósito abastecer a mis santos” (D. y C. 104:15). Esa revelación es una promesa del Señor de que Él le proveerá bendiciones temporales y abrirá la puerta de la autosuficiencia, la cual es la capacidad de proveernos los elementos indispensables para sostener nuestra vida y la de los miembros de nuestra familia.
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