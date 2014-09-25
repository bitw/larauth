@extends(Config::get('larauth::template'))

@section(Config::get('larauth::out'))
    <div class="col-md-offset-3 col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">{{trans('larauth::larauth.change_password')}}</div>
            <div class="panel-body">
                @if(!Session::get('processed'))
                    {{Form::open(['route'=>['larauth.new_password', 'email'=>$email, 'key'=>$key], 'method'=>'post', 'role'=>'form', 'class'=>'form-horizontal'])}}
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="password">{{trans('larauth::larauth.password')}}</label>
                            <div class="col-md-8">
                                {{Form::password('password', ['class'=>'form-control'])}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="password_confirmation">{{trans('larauth::larauth.confirm_password')}}</label>
                            <div class="col-md-8">
                                {{Form::password('password_confirmation', ['class'=>'form-control'])}}
                            </div>
                        </div>
                        @if($errors)
                            <div class="alert alert-danger">
                                {{implode('', $errors->all('<div>:message</div>'))}}
                            </div>
                        @endif
                        {{Form::submit(trans('larauth::larauth.save_password'), ['class'=>'btn btn-primary col-md-12'])}}
                    {{Form::close()}}
                @else
                    {{trans('larauth::larauth.password_change_success')}}
                @endif
            </div>
        </div>
    </div>
@endsection