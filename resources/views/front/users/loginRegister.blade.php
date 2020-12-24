@extends('layouts.front.front')
@section('content')
<div class="span9">
    <ul class="breadcrumb">
		<li><a href="{{ url('/') }}">Home</a> <span class="divider">/</span></li>
		<li class="active">Login</li>
    </ul>
	<h3> Login / Register</h3>	
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
		<div class="span4">
			<div class="well">
                <h5>CREATE YOUR ACCOUNT</h5>
                <form id="registerForm" action="{{ url('/register') }}" method="post">@csrf
                    <div class="control-group">
                        <label class="control-label" for="name">Name</label>
                        <div class="controls">
                            <input class="span3" type="text" id="name" name="name" placeholder="Name">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="mobile">Mobile</label>
                        <div class="controls">
                            <input class="span3" type="text" id="mobile" name="mobile" placeholder="Mobile">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="email">Email</label>
                        <div class="controls">
                            <input class="span3" type="text" id="email" name="email" placeholder="Email">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="password">Password</label>
                        <div class="controls">
                            <input class="span3" type="password" id="password" name="password" placeholder="Password">
                        </div>
                    </div>
                    <div class="controls">
                        <button type="submit" class="btn block">Create Your Account</button>
                    </div>
                </form>
		    </div>
		</div>
		<div class="span1"> &nbsp;</div>
            <div class="span4">
                <div class="well">
                <h5>ALREADY REGISTERED ?</h5>
                <form id="loginForm" action="{{ url('/login') }}" method="post">@csrf
                    <div class="control-group">
                        <label class="control-label" for="inputEmail1">Email</label>
                        <div class="controls">
                            <input class="span3"  type="text" id="loginEmail" name="email" placeholder="Email">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputPassword1">Password</label>
                        <div class="controls">
                            <input type="password" class="span3"  id="loginPass" name="password" placeholder="Password">
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <button type="submit" class="btn">Sign in</button> <a href="{{ url('/forgot-password') }}">Forget password?</a>
                        </div>
                    </div>
                </form>
            </div>
		</div>
	</div>	
</div>
@endsection

@section('script')
    <script>
        const validationRules = Object.assign({
                name: "required",
                mobile: {
                    required: true,
                    minlength: 11,
                    maxlength: 11,
                    digits: true,
                },
                email: {
                    required: true,
                    email: true,
                    remote: '/check-email'
                },
                password: {
                    required: true,
                    minlength: 6,
                },
        });

        const validationMessages = Object.assign({
                name: "Please enter your name",
                mobile: {
                    required: "Please enter your mobile number",
                },
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 6 characters long"
                },
                email: {
                    remote: "Email already exixts !",
                },
        });

        validation('#registerForm', validationRules, validationMessages);

        const rulesLogin = Object.assign({
                email: {
                    required: true,
                    email: true,
                },
                password: {
                    required: true,
                },
        });

        const msgLogin = Object.assign({
                email: {
                    required: "Please enter your email",
                },
                password: {
                    required: "Please enter your password",
                },
        });

        validation('#loginForm', rulesLogin, msgLogin);
    </script>
@endsection