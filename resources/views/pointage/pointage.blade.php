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
        <form action={{route('modifier_entrer')}} >
            @csrf
            <label for="modif_sortie">Modifier la sortie</label>
            <input type="time" name="modif_entree" class="form-control">
            <input type="text" name="pointage_id" value="{{ $pointage_id}}" hidden>
            <input type="submit" value="Valider">
        </form>
    </div>
    @elseif($boutton == 'sortie')
    <div style="display: inline-block">
        <form action={{route('valider_sortie')}}>
            @csrf
            <input type="number" class="form-control" name="pause" placeholder="Durée pause">
            <br>
            <input type="submit" class="btn btn-outline-primary btn-lg" value="Sortie">
        </form>
    </div>
    @elseif($boutton == 'oublie_sortie')
    <div style="display: inline-block">
        <form action={{route('modifier_sortie')}} >
            @csrf
            <label for="modif_sortie">Modifier la sortie</label>
            <input type="number" class="form-control" name="pause" placeholder="Durée pause">
            <br>
            <input type="time" name="modif_sortie" class="form-control">
            <input type="text" name="pointage_id" value="{{ $pointage_id}}" hidden>
            <input type="submit" value="Valider">
        </form>
    </div>
    @elseif($boutton == 'terminé')
    <div class="alert alert-warning" role="alert">
        <h5 class="alert-heading">Vous avez terminé tous vos pointages pour aujourd'hui.</h5>
        <p>On vous revoit demain !</p>
    </div>
    @elseif($boutton != 'terminé')
    <div class="alert alert-warning" role="alert">
        <h5 class="alert-heading">Vous n'avez pas terminé tous vos pointages hier.</h5>
        <p>Veuillez refaire votre pointage  !</p>
    </div>
    @endif
</div>
@endsection
