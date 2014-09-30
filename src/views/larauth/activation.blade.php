@extends(Config::get('larauth::template'))

@section(Config::get('larauth::out'))
    <div class="col-md-offset-3 col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">{{trans('larauth::larauth.activation')}}</div>
            <div class="panel-body">
                @if(!Session::get('activated'))
                    {{ Form::open(['route'=>'larauth.activation', 'method'=>'post', 'role'=>'form', 'class'=>'form-horizontal']) }}
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="email">{{ trans('larauth::larauth.activation_code') }}</label>
                            <div class="col-md-8">
                                {{Form::text('code', false, ['required'=>true, 'class'=>'form-control'])}}
                            </div>
                        </div>
                        @if($error)
                            <div class="alert error">{{$error}}</div>
                        @endif
                        {{Form::submit(trans('larauth::larauth.activate'), ['class'=>'btn btn-primary pull-right', 'on-click'=>'this.disabled=true;this.form.submit();'])}}
                    {{Form::close()}}
                    <div class="col-md-12 text-center">
                        {{link_to_route('larauth.requestcode', trans('larauth::larauth.request_activation_code'), [], ['class'=>'btn btn-link'])}}
                        {{link_to_route('larauth.logon', trans('larauth::larauth.sign_in'), [], ['class'=>'btn btn-link'])}}
                        {{link_to_route('larauth.registration', trans('larauth::larauth.registration'), [], ['class'=>'btn btn-link'])}}
                    </div>
                @else
                    <h4>{{trans('larauth::larauth.congratulations')}}</h4>
                    <p>{{trans('larauth::larauth.activated_success')}} {{trans('larauth::larauth.can_logon')}}</p>
                    <p>{{trans('larauth::larauth.userdata_sended_to_email')}}</p>
                @endif
            </div>
        </div>
    </div>
@endsection