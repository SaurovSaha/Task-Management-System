@extends('layout.app')

@section('title', 'Profile View')

@include('components.master.navbar')
{{-- @include('components.master.sidebar') --}}
@section('content')
    @include('components.dashboard.profile-form')
    
@endsection

