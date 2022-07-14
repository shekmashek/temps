@extends('layouts.admin')
@section('title')
<p class="text_header m-0 mt-1">Accueil
</p>
@endsection
@section('content')
    <form action={{route('valider_entrer')}} >
        <button type="submit" class="btn btn-info">i'm here</button>
    </form>
@endsection
