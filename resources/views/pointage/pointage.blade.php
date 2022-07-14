@extends('layouts.admin')
@section('title')
<p class="text_header m-0 mt-1">Accueil
</p>
@endsection
@section('content')
    <div class="input-group clockpicker">
        <input type="text" class="form-control" value="09:30">
        <span class="input-group-addon">
        <span class="glyphicon glyphicon-time"></span>
        </span>
    </div>
<script type="text/javascript">
    $('.clockpicker').clockpicker();
</script>
@endsection
