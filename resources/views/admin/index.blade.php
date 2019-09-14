@extends('layouts.app')
@section('title', 'Admin')

@section('nav')
@yield('nav', View::make('admin.partials.nav'))
@endsection
@section('content')
<app></app>
@endsection
