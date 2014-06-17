@extends(Config::get('Larauth::template'))

@section(Config::get('Larauth::out'))
    <div class="col-md-offset-3 col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">{{trans('Larauth::larauth.activation')}}</div>
            <div class="panel-body">
                @if(!Session::get('activated'))
                    {{Form::open(['route'=>'larauth.activation', 'method'=>'post', 'role'=>'form', 'class'=>'form-horizontal'])}}
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="email">{{trans('Larauth::larauth.activation_code')}}</label>
                            <div class="col-md-8">
                                {{Form::text('code', false, ['required'=>true, 'class'=>'form-control'])}}
                            </div>
                        </div>
                        @if($error)
                            <div class="alert error">{{$error}}</div>
                        @endif
                        {{Form::submit(trans('Larauth::larauth.activate'), ['class'=>'btn btn-primary pull-right'])}}
                    {{Form::close()}}
                    <div class="col-md-12 text-center">
                        {{link_to_route('larauth.requestcode', trans('Larauth::larauth.request_activation_code'), [], ['class'=>'btn btn-link'])}}
                        {{link_to_route('larauth.logon', trans('Larauth::larauth.sign_in'), [], ['class'=>'btn btn-link'])}}
                        {{link_to_route('larauth.registration', trans('Larauth::larauth.registration'), [], ['class'=>'btn btn-link'])}}
                    </div>
                @else
                    <h4>{{trans('Larauth::larauth.congratulations')}}</h4>
                    <p>{{trans('Larauth::larauth.activated_success')}} {{trans('Larauth::larauth.can_logon')}}</p>
                    <p>{{trans('Larauth::larauth.userdata_sended_to_email')}}</p>
                @endif
            </div>
        </div>
    </div>
@endsection