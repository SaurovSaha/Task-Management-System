@extends('layout.app-backend')

@section('title', 'Profile View')

@section('content')

    @include('components.dashboard.profile-form')
    @include('components.dashboard.profile-update')
    
@endsection

