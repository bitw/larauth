@extends(Config::get('Larauth::template'))

@section(Config::get('Larauth::out'))
    <div class="col-md-offset-3 col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">{{trans('Larauth::Larauth.registration')}}</div>
            <div class="panel-body">
                {{Form::open(['route'=>'larauth.registration', 'method'=>'post', 'role'=>'form', 'class'=>'form-horizontal'])}}
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="email">{{trans('Larauth::larauth.email')}}</label>
                        <div class="col-md-8">
                            {{Form::email('email', Session::get('email'), ['required'=>true, 'class'=>'form-control'])}}
                        </div>
                    </div>
                    @if(!Config::get('Larauth::registration.generate_password'))
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="password">{{trans('Larauth::larauth.password')}}</label>
                            <div class="col-md-8">
                                {{Form::password('password', ['class'=>'form-control'])}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="password_confirmation">{{trans('Larauth::larauth.confirm_password')}}</label>
                            <div class="col-md-8">
                                {{Form::password('password_confirmation', ['class'=>'form-control'])}}
                            </div>
                        </div>
                    @endif
                    @if(Config::get('Larauth::registration.captcha_protect'))
                        <div class="form-group">
                            <div class="col-md-offset-4 col-md-8">
                                {{Form::captcha()}}
                            </div>
                        </div>
                    @endif
                    @if($errors)
                        <div class="alert alert-danger">
                            {{implode('', $errors->all('<div>:message</div>'))}}
                        </div>
                    @endif
                    <div class="col-md-12">
                        {{Form::submit(trans('Larauth::larauth.registration'), ['class'=>'btn btn-primary col-md-12'])}}
                    </div>
                    <div class="col-md-12 text-center">
                        {{link_to_route('larauth.logon', trans('Larauth::larauth.authorization'), [], ['class'=>'btn btn-link'])}}
                        {{link_to_route('larauth.forgot_password', trans('Larauth::larauth.forgot_password'), [], ['class'=>'btn btn-link'])}}
                    </div>
                {{Form::close()}}
            </div>
        </div>
    </div>
@endsection