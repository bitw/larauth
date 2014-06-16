<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <h2>Поздавляем!</h2>
    @if(Config::get('Larauth::registration.require_activation'))
        <p>Ваша учетная запись создана, но ее необходимо активировать.</p>
        <p>
            Для активации Вам необходимо перейти по этой <?=link_to_route('larauth.activation', 'ссылке', ['code'=>$code])?><br/>
            (<?=route('larauth.activation', ['code'=>$code])?>)
        </p>
    @endif
</body>
</html>