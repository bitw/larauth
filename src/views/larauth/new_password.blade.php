@extends(Config::get('Larauth::template'))

@section(Config::get('Larauth::out'))
    @if(!Session::get('processed'))
        <?=Form::open(['route'=>['larauth.new_password', 'email'=>$email, 'key'=>$key]])?>
            <ul>
                <li>
                    <label for="password">{{trans('Larauth::larauth.password')}}</label><?=Form::password('password')?>
                </li>
                <li>
                    <label for="password_confirmation">{{trans('Larauth::larauth.confirm_password')}}</label><?=Form::password('password_confirmation')?>
                </li>
            </ul>
            @if($errors)
            <ul>{{implode('', $errors->all('<li>:message</li>'))}}</ul>
            @endif
            <?=Form::submit(trans('Larauth::larauth.save_password'))?>
        <?=Form::close()?>
    @else
        <h3>{{trans('Larauth::larauth.password_change_success')}}</h3>
    @endif
@endsection