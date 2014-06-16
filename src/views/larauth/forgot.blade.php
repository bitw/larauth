@extends(Config::get('Larauth::template'))

@section(Config::get('Larauth::out'))
	<h2><?=\Patchwork\Utf8::ucfirst(trans('Larauth::larauth.password_recovery'))?></h2>
	@if(!$processed)
		{{Form::open(['route'=>'larauth.forgot_password'])}}
			<ul>
				<li>
					<label for="email"><?=\Patchwork\Utf8::ucfirst(trans('Larauth::larauth.email'))?></label>
					<?=Form::email('email', Session::get('email'))?>
				</li>
			</ul>
			<?=Form::submit()?>
			{{link_to_route('larauth.logon', \Patchwork\Utf8::ucfirst(trans('Larauth::larauth.authorization')))}}
			{{link_to_route('larauth.registration', \Patchwork\Utf8::ucfirst(trans('Larauth::larauth.registration')))}}
		{{Form::close()}}
	@else
		<?=\Patchwork\Utf8::ucfirst(trans('Larauth::larauth.instruction_change_password_sended'))?>
	@endif
	@if($errors)
		<div class="alert">
			<ul>{{implode('', $errors->all('<li>:message</li>'))}}</ul>
		</div>
	@endif
@endsection