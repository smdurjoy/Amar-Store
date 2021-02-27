@extends('layouts.front.front')

@section('content')
    <div class="span9">
        <ul class="breadcrumb">
            <li><a href="{{ url('/') }}">Home</a> <span class="divider">/</span></li>
            <li class="active"> 404 not found</li>
        </ul>
        <hr class="soft"/>
        
        <div align="center">
            <h3>404 NOT FOUND</h3>
            <div style="font-size: 16px">Maybe this page moved? Got deleted? Is hiding out in quarantine? Never existed in the first place?
                <p>Let's go <a style="color:blue" href="{{ url('/') }}">home</a> and try from there.</p>
            </div>
        </div>
    </div>
@endsection