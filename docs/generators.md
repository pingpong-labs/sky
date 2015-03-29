Laravel Generators
==========

- [Installation](#installation)
- [Artisan Commands](#artisan-commands)
- [Scaffolding](#scaffold)

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

<a name="artisan-commands"></a>
## Artisan Commands

In this package there are many CLI commands that are useful to speed up you in creating web applications with Laravel. Some commands may already be familiar, such as the command to create a controller or model. However we are aware, sometimes we want everything instantly. Although not all of them can be so.

- [Generate a controller](#controller)
- [Generate a model](#model)
- [Generate a console command](#console)
- [Generate a form request](#request)
- [Generate a migration](#migration)
- [Generate a pivot migration](#pivot)
- [Generate a seed](#seed)
- [Generate a view](#view)
- [Generate a scaffold](#scaffold)

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

<a name="pivot"></a>
### Generate a pivot

```terminal
php artisan generate:pivot users roles
```

<a name="seed"></a>
### Generate a seed class

Create a basic database seeder class.

```terminal
php artisan generate:seed users
```

<a name="view"></a>
### Generate a view

Basic usage.

```terminal
php artisan generate:view index
```

Auto generate folder.

```terminal
php artisan generate:view users/index
```

Generate a plain/blank view.

```terminal
php artisan generate:view users/index --plain
```

Generate a master view.

```terminal
php artisan generate:view layouts/master --master
```

<a name="scaffold"></a>
### Generate a scaffolded resource

For some cases we may need to be faster in making resource. Let's say we're making a CRUD. First we have to create a migration, then the controller, and then the model and the others stuffs. If we use the commands to make it one by one, it is inefficient and will take a long time. That is where the "Generate: Scaffold" useful. With this command we can create a CRUD with just one command.

```
php artisan generate:scaffold task --fields="name:string, description=text"
```

From the example above we can see how easy it is to create a crud just one command. The first parameter is the name of entity being in singular convention. For example, if you want to create a `users` CRUD, you just need to use `user`. You have to follow singular convention.

```
php artisan generate:scaffold user
```

You can also specify the option "prefix" for this command. It is used as a "prefix" controller path , views, and also the route.

```
php artisan generate:scaffold task --fields="name:string, description=text" --prefix=admin
```