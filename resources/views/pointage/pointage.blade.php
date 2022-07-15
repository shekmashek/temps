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
            <input type="time" name="modif_entree">
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
            <input type="time" name="modif_sortie">
            <input type="submit" value="Validez">
        </form>
    </div>
    @elseif($boutton == 'terminé')
    <div class="alert alert-warning" role="alert">
        <h5 class="alert-heading">Vous avez terminé tous vos pointage pour aujourd'hui.</h5>
        <p>On vous revoit demain !</p>
    </div>
    @endif
</div>
@endsection
