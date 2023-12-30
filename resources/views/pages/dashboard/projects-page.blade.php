@extends('layout.app-backend')

@section('title', 'Dashboard')

@section('content')

    @include('components.dashboard.projects')
    @include('components.dashboard.project-create')
    @include('components.dashboard.project-update')
    
@endsection