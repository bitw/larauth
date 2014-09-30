<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>
    <h2>{{ trans('larauth::larauth.congratulations') }}</h2>
    @if(Config::get('larauth::registration.require_activation'))
        <p>
        	{{ trans('larauth::larauth.account_created_must_activate') }}
        </p>
        <p>
        	{{ trans('larauth::larauth.activation_code') }}: <strong>{{ $code }}</strong>
        </p>
        <p>
        	{{ trans('larauth::larauth.or_click_on_link') }}: {{ link_to_route('larauth.activation', route('larauth.activation', ['code'=>$code]), ['code'=>$code]) }}
        </p>
	@else
		<p>
			{{-- trans('larauth::larauth.authorization_data') }}:<br/>
			{{ trans('email') }}: {{ $email }}<br/>
			{{ trans('password') }}: {{ $password --}}
			------------------
		</p>
    @endif
</body>
</html>