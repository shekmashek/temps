@extends('layouts.admin')
@section('title')
<p class="text_header m-0 mt-1">Accueil
</p>
@endsection
@section('content')
    <form action="{{route('valider_entrer')}}" method="GET">
    @csrf
    <input type="submit" class="btn btn-primary">
    </form>
@endsection
