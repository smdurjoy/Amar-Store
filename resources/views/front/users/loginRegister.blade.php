@extends('layouts.front.front')
@section('content')
<!-- Begin Li's Breadcrumb Area -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li class="active">Login Register</li>
            </ul>
        </div>
    </div>
</div>
    <!-- Begin Login Content Area -->
    <div class="page-section mb-60">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
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
                    @if($errors->any())
                        <div class="alert alert-danger mt-3" role="alert">
                            <ul>
                                @foreach( $errors->all() as $error )
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-30">
                    <!-- Login Form s-->
                    <form id="loginForm" action="{{ url('/login') }}" method="post">@csrf
                        <div class="login-form">
                            <h4 class="login-title">Login</h4>
                            <div class="row">
                                <div class="col-md-12 col-12 mb-20">
                                    <label>Email Address*</label>
                                    <input class="mb-0" id="loginEmail" name="email" type="email" placeholder="Email Address">
                                </div>
                                <div class="col-12 mb-20">
                                    <label>Password</label>
                                    <input class="mb-0" type="password" id="loginPass" name="password" placeholder="Password">
                                </div>
                                <div class="col-md-8">
                                    <div class="check-box d-inline-block ml-0 ml-md-2 mt-10">
                                        <input type="checkbox" id="remember_me">
                                        <label for="remember_me">Remember me</label>
                                    </div>
                                </div>
                                <div class="col-md-4 mt-10 mb-20 text-left text-md-right">
                                    <a href="{{ url('/forgot-password') }}"> Forgotten pasward?</a>
                                </div>
                                <div class="col-md-12">
                                    <button class="register-button mt-0" type="submit">Login</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">
                    <form id="registerForm" action="{{ url('/register') }}" method="post">@csrf
                        <div class="login-form">
                            <h4 class="login-title">Register</h4>
                            <div class="row">
                                <div class="col-md-6 col-12 mb-20">
                                    <label>Name</label>
                                    <input class="mb-0" type="text" id="name" name="name" placeholder="Name">
                                </div>
                                <div class="col-md-6 col-12 mb-20">
                                    <label>Mobile</label>
                                    <input class="mb-0" type="text" id="mobile" name="mobile" placeholder="Mobile">
                                </div>
                                <div class="col-md-12 mb-20">
                                    <label>Email Address</label>
                                    <input class="mb-0" type="email" id="email" name="email" placeholder="Email Address">
                                </div>
                                <div class="col-md-6 mb-20">
                                    <label>Password</label>
                                    <input class="mb-0" type="password" id="password" name="password" placeholder="Password">
                                </div>
                                <div class="col-md-6 mb-20">
                                    <label>Confirm Password</label>
                                    <input class="mb-0" type="password" placeholder="Confirm Password">
                                </div>
                                <div class="col-12">
                                    <button class="register-button mt-0">Register</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Login Content Area End Here -->
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