@extends('layout.app-backend')

@section('title', 'Dashboard')

@section('content')

    @include('components.dashboard.tasks')
    @include('components.dashboard.task-create')
    @include('components.dashboard.task-update')
    
@endsection