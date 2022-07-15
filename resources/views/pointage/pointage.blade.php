@extends('layouts.admin')
@section('title')
<p class="text_header m-0 mt-1">Accueil
</p>
@endsection
@section('content')
<div align="center">
    @if(session()->has('msg'))
            <div class="alert alert-success">
                {{ session()->get('msg') }}
            </div>
    @endif
    @if(session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
    @endif
    @if($boutton == 'entrée')
    <div style="display: inline-block">
        <form action={{route('valider_entrer')}} >
            @csrf
            <input type="submit" class="btn btn-outline-success btn-lg" value="Entrée">
        </form>
    </div>
    @elseif($boutton == 'oublie_entree')
    <div style="display: inline-block">
        <form action={{route('valider_entrer')}} >
            @csrf
            <input type="time" id="appt" name="appt">
            <input type="submit" value="Validez">
        </form>
    </div>
    @elseif($boutton == 'sortie')
    <div style="display: inline-block">
        <form action={{route('valider_sortie')}} >
            @csrf
            <input type="submit" class="btn btn-outline-primary btn-lg" value="Sortie">
        </form>
    </div>
    @elseif($boutton == 'oublie_sortie')
    <div style="display: inline-block">
        <form action={{route('valider_entrer')}} >
            @csrf
            <input type="time" id="appt" name="appt">
            <input type="submit" value="Validez">
        </form>
    </div>
    @elseif($boutton == 'terminé')
    <div class="alert alert-warning" role="alert">
        <h5 class="alert-heading">Vous avez terminé tous vos pointage pour aujourd'hui.</h5>
        <p>On vous revoit demain !</p>
    </div>
    @elseif($boutton == 'oublie_sortie')
    <div class="alert alert-warning" role="alert">
        <h5 class="alert-heading">avez terminé tous vos pointage pour aujourd'hui.</h5>
        <p>On vous revoit demain !</p>
    </div>
    @endif
<<<<<<< HEAD
    <div>
        <form action={{route('valider_entrer')}} >
            @csrf
            <input type="hidden" name="pointage_id" value="{{$pointage_id}}">
        </form>
    </div>
=======

>>>>>>> 6b94355de8ecccf1b4dc87b809bd7106dc9f4533
</div>
@endsection
