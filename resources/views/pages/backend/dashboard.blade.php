@extends('layouts.backend.default', ['page' => 'dashboard'])
@section('title', 'Dashboard')

@section('content')
@include('pages.backend.__widget.default')
@include('pages.backend.__widget.custom')
@endsection
