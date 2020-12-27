@extends('layouts.front.front')
@section('content')
<div class="span9">
    <ul class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a> <span class="divider">/</span></li>
        <li class="active">Forget password?</li>
    </ul>
    <h3> FORGET YOUR PASSWORD?</h3>	
    <hr class="soft"/>
	@if(Session::has('successMessage'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('successMessage')  }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(Session::has('errorMessage'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('errorMessage')  }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="row">
        <div class="span9" style="min-height:900px">
            <div class="well">
                <h5>Reset your password</h5><br/>
                Please enter the email address for your account. A verification code will be sent to you. Once you have received the verification code, you will be able to choose a new password for your account.<br/><br/><br/>
                <form action="{{ url('/forgot-password') }}" method="post">@csrf
                    <div class="control-group">
                    <label class="control-label" for="inputEmail1">E-mail address</label>
                    <div class="controls">
                        <input class="span3" name="email" type="email" placeholder="Email" required>
                    </div>
                    </div>
                    <div class="controls">
                    <button type="submit" class="btn block">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>	
</div>
@endsection