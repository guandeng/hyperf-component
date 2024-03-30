# Hyperf Alaram


The alarm component for Hyperf.

## Installation

- Installation

```shell
composer require hyperf-component/alarm
```

## 发布配置

```shell script
php bin/hyperf.php vendor:publish hyperf-component/alarm
```

## Add Middleware

```php
<?php

// config/autoload/middlewares.php

return [
    'http' => [
        HyperfComponent\Alarm\Middleware\AlarmMiddleware::class,
    ],
];

```