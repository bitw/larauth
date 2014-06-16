@extends(Config::get('Larauth::template'))

@section(Config::get('Larauth::out'))
    <?=Form::open(['route'=>['larauth.new_password', 'email'=>$email, 'key'=>$key]])?>
        <ul>
            <li>
                <label for="password">password</label><?=Form::password('password')?>
            </li>
            <li>
                <label for="password_confirmation">confirm password</label><?=Form::password('password_confirmation')?>
            </li>
        </ul>
        <?=Form::submit(trans('Larauth::larauth.save_password'))?>
    <?=Form::close()?>
    @if($errors)
        <ul>{{implode('', $errors->all('<li>:message</li>'))}}</ul>
    @endif
@endsection