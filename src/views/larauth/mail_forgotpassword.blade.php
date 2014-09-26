<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<h2>{{trans('larauth::larauth.password_recovery')}}</h2>
<p>
    Для создания нового пароля перейдите по ссылке:<br/>
    {{route('larauth.new_password', ['email'=>$email, 'key'=>$key])}}
</p>
</body>
</html>
