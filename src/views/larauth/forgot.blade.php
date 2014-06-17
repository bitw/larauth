@extends(Config::get('Larauth::template'))

@section(Config::get('Larauth::out'))
    <div class="col-md-offset-4 col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">{{trans('Larauth::Larauth.password_recovery')}}</div>
            <div class="panel-body">
                @if(!$processed)
                    {{Form::open(['route'=>'larauth.forgot_password', 'role'=>'form', 'class'=>'form-horizontal'])}}
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="email">{{trans('Larauth::larauth.email')}}</label>
                            <div class="col-md-8">
                                {{Form::email('email', Session::get('email'), ['class'=>'form-control'])}}
                            </div>
                        </div>
                        <div class="col-md-12">
                            {{Form::submit(trans('Larauth::larauth.recovery'), ['class'=>'btn btn-primary col-md-12'])}}
                        </div>
                        <div class="col-md-12 text-center">
                            {{link_to_route('larauth.logon', trans('Larauth::larauth.authorization'), [], ['class'=>'btn btn-link'])}}
                            {{link_to_route('larauth.registration', trans('Larauth::larauth.registration'), [], ['class'=>'btn btn-link'])}}
                        </div>
                    {{Form::close()}}
                @else
                    {{trans('Larauth::larauth.instruction_change_password_sended')}}
                @endif
                @if($errors)
                    <div class="alert alert-danger">
                        {{implode('', $errors->all('<div>:message</div>'))}}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection