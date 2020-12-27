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
    @if($errors->any())
        <div class="alert alert-danger mt-3" role="alert">
            <ul>
                @foreach( $errors->all() as $error )
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

	<div class="row">   
		<div class="span4">
			<div class="well">
                <h5>CONTACT DETAILS</h5>
                <form id="accountForm" action="{{ url('/account') }}" method="post">@csrf
                    <div class="control-group">
                        <label class="control-label" for="name">Name</label>
                        <div class="controls">
                            <input class="span3" type="text" id="name" name="name" placeholder="Name" value="{{ $userDetails['name'] }}">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="address">Address</label>
                        <div class="controls">
                            <input class="span3" type="text" id="address" name="address" placeholder="Address" value="{{ $userDetails['address'] }}">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="city">City</label>
                        <div class="controls">
                            <input class="span3" type="text" id="city" name="city" placeholder="City" value="{{ $userDetails['city'] }}">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="state">State</label>
                        <div class="controls">
                            <input class="span3" type="text" id="state" name="state" placeholder="State" value="{{ $userDetails['state'] }}">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="country">Select Country</label>
                        <div class="controls">
                            <select class='form-control select2' style='width: 100%;' id='country' name='country'>
                                <option value="">Select</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country['country_name'] }}"
                                    @if($country['country_name'] == $userDetails['country']) selected @endif
                                    >
                                    {{ $country['country_name'] }}  
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="pinCode">Pin Code</label>
                        <div class="controls">
                            <input class="span3" type="text" id="pinCode" name="pinCode" placeholder="Pin Code" value="{{ $userDetails['pincode'] }}">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="mobile">Mobile</label>
                        <div class="controls">
                            <input class="span3" type="text" id="mobile" name="mobile" placeholder="Mobile" value="{{ $userDetails['mobile'] }}">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="email">Email</label>
                        <div class="controls">
                            <input class="span3" type="text" value="{{ $userDetails['email'] }}" readonly>
                        </div>
                    </div>
                    <div class="controls">
                        <button type="submit" class="btn block">Update</button>
                    </div>
                </form>
		    </div>
		</div>
		<div class="span1"> &nbsp;</div>
            <div class="span4">
                <div class="well">
                <h5>UPDATE PASSWORD</h5>
                <form id="updatePass" action="{{ url('/login') }}" method="post">@csrf
                    <div class="control-group">
                        <label class="control-label" for="currentPassword">Current Password</label>
                        <div class="controls">
                            <input class="span3" type="text" id="currentPassword" name="current_password" placeholder="Current password">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="newPassword">New Password</label>
                        <div class="controls">
                            <input type="password" class="span3" id="newPassword" name="new_password" placeholder="New password">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="confNewPassword">Confim New Password</label>
                        <div class="controls">
                            <input type="password" class="span3" id="confNewPassword" name="confirm_new_password" placeholder="Enter the password again">
                        </div>
                    </div>  
                    <div class="control-group">
                        <div class="controls">
                            <a href="{{ url('/update-password') }}" class="btn">Update</a>
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
                name: {
                    required: true,
                },
                mobile: {
                    required: true,
                    minlength: 11,
                    maxlength: 11,
                    digits: true,
                },
        });

        const validationMessages = Object.assign({
                name: {
                    required: "Please enter your name",
                },
                mobile: {
                    required: "Please enter your mobile number",
                },
        });

        validation('#accountForm', validationRules, validationMessages);
    </script>
@endsection