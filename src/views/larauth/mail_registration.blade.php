<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <h2>{{ trans('larauth::larauth.congratulations') }}</h2>
    <p>{{ trans('larauth::larauth.registration_completed') }}</p>
    <p>
        {{ trans('larauth::larauth.authorization_data') }}:<br/>
        {{ trans('email') }}: {{ $email }}<br/>
        {{ trans('password') }}: {{ $password }}
    </p>
</body>
</html>