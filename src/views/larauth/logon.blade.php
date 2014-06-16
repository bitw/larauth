@extends(Config::get('Larauth::template'))

@section(Config::get('Larauth::out'))
	{{Form::open(['route'=>'larauth.logon', 'method'=>'post'])}}
		<h3>{{\Patchwork\Utf8::ucfirst(trans('Larauth::Larauth.authorization'))}}</h3>
		<ul>
			<li>
				<label for="email">{{\Patchwork\Utf8::ucfirst(trans('Larauth::Larauth.email'))}}:&nbsp;
					<?=Form::email('email', Session::get('email'), ['required'=>true])?>
				</label>
			</li>
			<li>
				<label for="password">{{\Patchwork\Utf8::ucfirst(trans('Larauth::larauth.password'))}}:&nbsp;
					{{Form::password('password')}}
				</label>
			</li>
			<li>
				<label for="remember">
					{{Form::checkbox('remember', 1, Session::get('remember'))}}&nbsp;{{\Patchwork\Utf8::ucfirst(trans('Larauth::larauth.remember'))}}
				</label>
			</li>
		</ul>
		@if($errors)
			<div class="alert">
				<ul>{{implode('', $errors->all('<li>:message</li>'))}}</ul>
			</div>
		@endif
		{{Form::submit()}}
		{{link_to_route('larauth.registration', \Patchwork\Utf8::ucfirst(trans('Larauth::larauth.registration')))}}
		{{link_to_route('larauth.forgot_password', \Patchwork\Utf8::ucfirst(trans('Larauth::larauth.forgot_password').'?'))}}
	{{Form::close()}}
@endsection