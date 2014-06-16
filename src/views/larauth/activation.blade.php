@extends(Config::get('Larauth::template'))

@section(Config::get('Larauth::out'))
    @if(!Session::get('activated'))
        <p></p>
        {{Form::open(['route'=>'larauth.activation'])}}
            <h2>{{trans('Larauth::larauth.activation')}}</h2>
            <div>
                {{Form::label('code', trans('Larauth::larauth.activation_code'))}}
                {{Form::text('code')}} {{Form::submit(trans('Larauth::larauth.activate'))}}
            </div>
            @if($error)
                <div class="alert error">{{$error}}</div>
            @endif
        {{Form::close()}}
        {{link_to_route('larauth.requestcode', trans('Larauth::larauth.request_activation_code'))}}
        {{link_to_route('larauth.logon', trans('Larauth::larauth.sign_in'))}}
        {{link_to_route('larauth.registration', trans('Larauth::larauth.registration'))}}
    @else
        <h2>{{trans('Larauth::larauth.congratulations')}}</h2>
        <p>{{trans('Larauth::larauth.activated_success')}} {{trans('Larauth::larauth.can_logon')}}</p>
        <p>{{trans('Larauth::larauth.userdata_sended_to_email')}}</p>
    @endif
@endsection