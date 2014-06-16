@extends(Config::get('Larauth::template'))

@section(Config::get('Larauth::out'))
    {{Form::open(['route'=>'larauth.requestcode'])}}
        <h2>{{trans('Larauth::larauth.request_code')}}</h2>
        <div>
            {{Form::label('email', trans('Larauth::larauth.email'))}}
            {{Form::email('email')}} {{Form::submit(trans('Larauth::larauth.request'))}}
        </div>
        @if($errors)
            <div class="alert">
                <ul>{{implode('', $errors->all('<li>:message</li>'))}}</ul>
            </div>
        @endif
    {{Form::close()}}
    {{link_to_route('larauth.logon', trans('Larauth::larauth.sign_in'))}}
    {{link_to_route('larauth.registration', trans('Larauth::larauth.registration'))}}
    {{link_to_route('larauth.activation', trans('Larauth::larauth.activation'))}}
@endsection