@extends(Config::get('Larauth::template'))

@section(Config::get('Larauth::out'))
	{{Form::open(['route'=>'larauth.registration', 'method'=>'post'])}}
		<h3>{{\Patchwork\Utf8::ucfirst(trans('Larauth::larauth.registration'))}}</h3>
		<ul>
			<li>
				<label for="email">{{\Patchwork\Utf8::ucfirst(trans('Larauth::larauth.email'))}}:&nbsp;
					<?=Form::email('email', Session::get('email'), ['required'=>true])?>
				</label>
			</li>
			@if(!Config::get('Larauth::registration.generate_password'))
				<li>
					<label for="password">{{\Patchwork\Utf8::ucfirst(trans('Larauth::larauth.password'))}}:&nbsp;
						<?=Form::password('password')?>
					</label>
				</li>
				<li>
					<label for="password_confirmation">{{\Patchwork\Utf8::ucfirst(trans('Larauth::larauth.confirm_password'))}}:&nbsp;
						<?=Form::password('password_confirmation')?>
					</label>
				</li>
			@endif
			@if(Config::get('Larauth::registration.captcha_protect'))
				<li>
					{{Form::captcha()}}
				</li>
			@endif
		</ul>
		@if($errors)
			<div class="alert">
				<ul>{{implode('', $errors->all('<li>:message</li>'))}}</ul>
			</div>
		@endif
		{{Form::submit(\Patchwork\Utf8::ucfirst(trans('Larauth::larauth.registration')))}}
		{{link_to_route('larauth.logon', \Patchwork\Utf8::ucfirst(trans('Larauth::larauth.authorization')))}}
		{{link_to_route('larauth.forgot_password', \Patchwork\Utf8::ucfirst(trans('Larauth::larauth.forgot_password').'?'))}}
	{{Form::close()}}
@endsection