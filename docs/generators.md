Laravel Generators
==========

- [Installation](#installation)
- [Generate a controller](#controller)
- [Generate a model](#model)
- [Generate a console command](#console)
- [Generate a migration](#migration)

<a name="installation"></a>
## Installation

```
composer require "pingpong/generators:2.0.*@dev"
```

Next, register new service provider to `providers` array in `app/config/app.php`.

```php
'Pingpong\Generators\GeneratorsServiceProvider'
```

Done.

<a name="controller"></a>
### Generate a new controller

Generate a basic controller.

```terminal
php artisan generate:controller UsersController
```

Generate a resource controller.

```terminal
php artisan generate:controller UsersController --resource
# OR
php artisan generate:controller UsersController -r
```

Generate a scaffolded controller.

```
php artisan generate:controller UsersController --scaffold
# OR
php artisan generate:controller UsersController -s
```

<a name="model"></a>
### Generate a new model

```php
php artisan generate:model User

php artisan generate:model Users/User
```

<a name="console"></a>
### Generate a new console

```
php artisan generate:console FooCommand

php artisan generate:console FooCommand --command="foo" --description="a console"
```

<a name="request"></a>
### Generate a new form request

```
php artisan generate:request CreateUserRequest
```

You can also specify `rules`.

```
php artisan generate:request CreateUserRequest --rules="username:required, email:required,email"

php artisan generate:request CreateUserRequest --rules="username:unique(users;username)"
```

<a name="migration"></a>
### Generate a new migration

Generate a basic migration.

```
php artisan generate:migration create_users_table
```

Generate a migration with specify the fields.

```
php artisan generate:migration create_users_table --fields="username:string, email:string:unique, remember_token, soft_delete"
```

Add new field to an existing table.
```
php artisan generate:migration add_password_to_users_table --fields="password:string"
```

Remove column from a specify table.

```
php artisan generate:migration remove_password_from_users_table --fields="password:string"
```

Drop a specify table.
```
php artisan generate:migration drop_users_table
```

