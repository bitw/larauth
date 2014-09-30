@extends(Config::get('larauth::template'))

@section(Config::get('larauth::out'))
    <div class="col-md-offset-4 col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">{{ trans('larauth::larauth.password_recovery') }}</div>
            <div class="panel-body">
                @if(!$processed)
                    {{ Form::open(['route'=>'larauth.forgot_password', 'role'=>'form', 'class'=>'form-horizontal']) }}
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="email">{{ trans('larauth::larauth.email') }}</label>
                            <div class="col-md-8">
                                {{ Form::email('email', Session::get('email'), ['class'=>'form-control']) }}
                            </div>
                        </div>
                        @if($errors)
							<div class="col-md-12">
								<div class="alert alert-danger">
									{{ implode('', $errors->all('<div>:message</div>')) }}
								</div>
							</div>
						@endif
                        <div class="col-md-12">
                            {{ Form::submit(trans('larauth::larauth.recovery'), ['class'=>'btn btn-primary col-md-12', 'onclick'=>'this.disabled=true;this.form.submit();']) }}
                        </div>
                        <div class="col-md-12 text-center">
                            {{ link_to_route('larauth.logon', trans('larauth::larauth.authorization'), [], ['class'=>'btn btn-link']) }}
                            {{ link_to_route('larauth.registration', trans('larauth::larauth.registration'), [], ['class'=>'btn btn-link']) }}
                        </div>
                    {{ Form::close() }}
                @else
                    {{ trans('larauth::larauth.instruction_change_password_sended') }}
                @endif
            </div>
        </div>
    </div>
@endsection