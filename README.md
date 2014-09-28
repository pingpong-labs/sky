Unit Testing Helper for Laravel's Package
=========

This package is inspired from orchestra/testbench package

[![Build Status](https://travis-ci.org/pingpong-labs/testing.svg)](https://travis-ci.org/pingpong-labs/testing)

### Quick Installation Via Composer

```
composer require "pingpong/testing:1.*"
```

### Your First Test

```php
use Pingpong\Testing\TestCase;

class LoginControllerTest extends TestCase {

    public function testGetLogin()
    {
        $this->call('GET', '/login');
        $this->assertResponseOk();
    }
}
```

### License

This package is open-sourced software licensed under [The BSD 3-Clause License](http://opensource.org/licenses/BSD-3-Clause)
