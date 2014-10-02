<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<h2>{{trans('larauth::larauth.password_recovery')}}</h2>
<p>
    {{ trans('larauth::larauth.click_for_create_new_password') }}:
    {{ link_to_route('larauth.new_password', route('larauth.new_password', ['email'=>$email, 'key'=>$key]), ['email'=>$email, 'key'=>$key]) }}
</p>
</body>
</html>
