Unit Testing Laravel's Package
=========

- [Installation](#quick-installation-via-composer)
- [Example Usage](#example-usage)
- [License](#license)

### Quick Installation Via Composer

```
composer require "pingpong/testing:~2.0"
```

### Example Usage

Your First Test.

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

Register The Package's Providers And Aliases.

```php
use Pingpong\Testing\TestCase;

class MasterTestCase extends TestCase {

    public function getPackageAliases()
    {
        return [
            'Sample' => 'Vendor\Sample\Facades\Sample'
        ];
    }

    public function getPackageProviders()
    {
        return [
            'Vendor\Sample\SampleServiceProvider'
        ];
    }
}
```

Register custom booted callback.

```php
use Pingpong\Testing\TestCase;

class MasterTestCase extends TestCase {

    protected function registerBootedCallback($app)
    {
        include __DIR__ . '/../routes.php';
    }
}
```

Setup Your Application Timezone.

```php

use Pingpong\Testing\TestCase;

class MasterTestCase extends TestCase {

    protected function getApplicationTimezone()
    {
        return 'Asia/Jakarta';
    }
}
```

### License

This package is open-sourced software licensed under [The BSD 3-Clause License](http://opensource.org/licenses/BSD-3-Clause)
