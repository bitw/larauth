@extends(Config::get('Larauth::template'))

@section(Config::get('Larauth::out'))
    <div class="col-md-offset-4 col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">{{trans('Larauth::Larauth.authorization')}}</div>
            <div class="panel-body">
                {{Form::open(['route'=>'larauth.logon', 'method'=>'post', 'role'=>'form', 'class'=>'form-horizontal'])}}
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="email">{{trans('Larauth::Larauth.email')}}</label>
                        <div class="col-md-8">
                            {{Form::email('email', Session::get('email'), ['required'=>true, 'class'=>'form-control'])}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="password">{{trans('Larauth::larauth.password')}}</label>
                        <div class="col-md-8">
                            {{Form::password('password', ['class'=>'form-control'])}}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-4 col-md-8">
                            <div class="checkbox">
                                <label for="remember">
                                    {{Form::checkbox('remember', 1, Session::get('remember'))}}&nbsp;{{trans('Larauth::larauth.remember')}}
                                </label>
                            </div>
                        </div>
                    </div>
                    @if($errors)
                        <div class="alert alert-danger">
                            {{implode('', $errors->all('<div>:message</div>'))}}
                        </div>
                    @endif
                    <div class="col-md-12">
                        {{Form::submit(trans('Larauth::larauth.sign_in'), ['class'=>'btn btn-primary col-md-12'])}}
                    </div>
                    <div class="col-md-12 text-center">
                        {{link_to_route('larauth.registration', trans('Larauth::larauth.registration'), [], ['class'=>'btn btn-link'])}}
                        {{link_to_route('larauth.forgot_password', trans('Larauth::larauth.forgot_password'), [], ['class'=>'btn btn-link'])}}
                    </div>
                {{Form::close()}}
            </div>
        </div>
    </div>
@endsection