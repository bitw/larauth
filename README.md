larauth
=======

Данный пакет является дополнением к пакету [Cartalyst/Sentry](https://cartalyst.com/manual/sentry).

Реализовалы формы и уведомления на эл.почту:
- Регистрация
- Авторизация
- Восстановление пароля

##Установка
Выполняем `composer require bitw/larauth:dev-master`
Импортируем конфигурацию `php artisan config:publish bitw/larauth`
Импортируем шаблоны `php artisan view:publish bitw/larauth`

###Параметры конфигурации
Для защиты от "лишних" регистаций можно подключить и сконфигурировать [Recaptcha](http://www.google.com/recaptcha/intro/index.html) и включить его в конфиге `'captcha_protect' => true`
Параметр `'generate_password' => true` автоматически сгенерирует пароль и скрывает при регистрации поля ввода пароля и подтверждения.
За включение/отключение необходимости активации учетной записи после регистрации отвечает параметр `'require_activation' => true`.
Так же можно установить проверки минимальной длинны пароля `min_password' => 6`
