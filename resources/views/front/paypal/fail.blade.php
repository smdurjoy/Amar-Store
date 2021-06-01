@extends('layouts.front.front')

@section('content')
    <div class="span9">
        <ul class="breadcrumb">
            <li><a href="{{ url('/') }}">Home</a> <span class="divider">/</span></li>
            <li class="active"> failed</li>
        </ul>
        <hr class="soft"/>
        
        <div align="center">
            <h3>YOUR ORDER HAS BEEN FAILED.</h3>
            <h5>Please try again after some time and contact us if there is any enquiry.</h5>
            <a href="{{ url('/') }}">Back to home</a> 
        </div>
    </div>
@endsection