@extends('admin.layout')

@section('title', 'Detalle minuto')

@section('content')
<?php
    $tm = sprintf("%02d:%02d", $hour, $minute);
?>
<div class="row mb-3">
    <div class="col-12">
        <h1 class="h4">Time {{ $tm }}</h1>
    </div>
</div>

<div class="row">
    @foreach ($times as $t)
        <div class="col-12 col-md-6 col-lg-4 mb-3">
            <img src="{{ $t['picture'] }}" alt="Time {{ $tm }}" class="img-fluid rounded">
        </div>
    @endforeach
</div>
@endsection

