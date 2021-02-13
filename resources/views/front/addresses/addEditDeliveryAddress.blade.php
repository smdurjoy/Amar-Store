@extends('layouts.front.front')
@section('content')
<div class="span9">
    <ul class="breadcrumb">
		<li><a href="{{ url('/') }}">Home</a> <span class="divider">/</span></li>
		<li class="active">Delivery Address</li>
    </ul>
	<h3>{{ $title }}</h3>	
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
                <h5>Delivery Address Details</h5>
                <form id="deliveryAddressForm" @if(empty($addressData['id'])) action="{{ url('/add-edit-delivery-address') }}" @else action="{{ url('/add-edit-delivery-address/'.$addressData['id']) }}" @endif method="post">@csrf
                    <div class="control-group">
                        <label class="control-label" for="name">Name</label>
                        <div class="controls">
                            <input class="span3" type="text" id="name" name="name" placeholder="Name" @if(!empty($addressData['name'])) value="{{ $addressData['name'] }}" @else value="{{ old('name') }}" @endif>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="address">Address</label>
                        <div class="controls">
                            <input class="span3" type="text" id="address" name="address" placeholder="Address" @if(!empty($addressData['address'])) value="{{ $addressData['address'] }}" @else value="{{ old('address') }}" @endif>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="city">City</label>
                        <div class="controls">
                            <input class="span3" type="text" id="city" name="city" placeholder="City" @if(!empty($addressData['city'])) value="{{ $addressData['city'] }}" @else value="{{ old('city') }}" @endif>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="state">State</label>
                        <div class="controls">
                            <input class="span3" type="text" id="state" name="state" placeholder="State" @if(!empty($addressData['state'])) value="{{ $addressData['state'] }}" @else value="{{ old('state') }}" @endif>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="country">Select Country</label>
                        <div class="controls">
                            <select class='form-control select2' style='width: 100%;' id='country' name='country'>
                                <option value="">Select</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country['country_name'] }}" @if(!empty($addressData['country']) && $addressData['country'] == $country['country_name']) selected @endif>
                                    {{ $country['country_name'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>  
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="pincode">Pin Code</label>
                        <div class="controls">
                            <input class="span3" type="text" id="pincode" name="pincode" placeholder="Pin Code" @if(!empty($addressData['pincode'])) value="{{ $addressData['pincode'] }}" @else value="{{ old('pincode') }}" @endif>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="mobile">Mobile</label>
                        <div class="controls">
                            <input class="span3" type="text" id="mobile" name="mobile" placeholder="Mobile" @if(!empty($addressData['mobile'])) value="{{ $addressData['mobile'] }}" @else value="{{ old('mobile') }}" @endif>
                        </div>
                    </div>
                    <div class="controls">
                        <button type="submit" class="btn block btn-info">Submit</button>
                        <a href="{{ url('/checkout') }}" class="btn block">Go Back</a>
                    </div>
                </form>
		    </div>
		</div>
	</div>	
</div>
@endsection

@section('script')
    <script>
        // Address add edit jQuery validation
        const validationRules = Object.assign({
                name: {
                    required: true,
                },
                address: {
                    required: true,
                },
                city: {
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
                    required: "Please enter your name.",
                },
                mobile: {
                    required: "Please enter your mobile number.",
                },
                address: {
                    required: "Please enter your address.",
                },
                city: {
                    required: "Please enter your city.",
                },
        });

        validation('#deliveryAddressForm', validationRules, validationMessages);
    </script>
@endsection