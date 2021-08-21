@extends('layouts.front.front')

@section('content')
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li class="active"> 404</li>
            </ul>
        </div>
    </div>
</div>
<div class="content-wraper pt-60 pb-60 pt-sm-30">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div align="center">
                    <h3>404 NOT FOUND</h3>
                    <div style="font-size: 16px">Maybe this page moved? Got deleted? Is hiding out in quarantine? Never existed in the first place?
                        <p>Let's go <a style="color:blue" href="{{ url('/') }}">home</a> and try from there.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection