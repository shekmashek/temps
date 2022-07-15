@extends('layouts.admin')
@section('title')
<p class="text_header m-0 mt-1">Accueil
</p>
@endsection
@section('content')
<div align="center">
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
    @elseif($boutton == 'sortie')
    <div style="display: inline-block">
        <form action={{route('valider_sortie')}} >
            @csrf
            <input type="submit" class="btn btn-outline-primary btn-lg" value="Sortie">
        </form>
    </div>
    @else
    <div class="alert alert-warning" role="alert">
        <h4 class="alert-heading">Attention</h4>
        <p>Vous avez déjà effectué un pointage</p>
    </div>
    @endif
</div>
@endsection
