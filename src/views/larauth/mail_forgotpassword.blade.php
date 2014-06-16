<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<h2>{{trans('Larauth::larauth.password_recovery')}}</h2>
<p>
    Для создания нового паролья перейдите по ссылке:<br/>
    {{route('larauth.new_password', ['email'=>$email, 'key'=>$key])}}
</p>
</body>
</html>