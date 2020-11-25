## Google Authenticator Laravel Package


* Copyright (c) 2020, [Phi Hoang JSC](https://github.com/hoangphidev)
* Author: Phi Hoang, [@hoangphidev](https://github.com/hoangphidev) and [contributors](https://github.com/hoangphidev/google-2fa/graphs/contributors)
* Licensed under the MIT License.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/hoangphi/google-2fa.svg?style=flat-square)](https://packagist.org/packages/hoangphi/google-2fa)
[![Total Downloads](https://img.shields.io/packagist/dt/hoangphi/google-2fa.svg?style=flat-square)](https://packagist.org/packages/hoangphi/google-2fa)

## Install

```shell
composer require hoangphi/google-2fa
```

## Config

Add column `secret_code`

```shell
php artisan google-2fa:make <table_name>
```

### Example

Add column `secret_code` into table `users`

```shell
php artisan google-2fa:make users
```

We have file `database\migrations\{time_stamp}_add_secret_code_to_users.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSecretCodeToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('secret_code')->nullable()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('secret_code');
        });
    }
}

```

Run `migrate` command

```shell
php artisan migrate
```

You must migrate table `users` before.

## Usage

See following example:

```php
use HoangPhi\GoogleAuthenticator\GoogleAuthenticator;

$googleAuthenticator = new GoogleAuthenticator();
$secret = $googleAuthenticator->createSecret();
echo "Secret is: " . $secret . "\n\n";

$qrCodeUrl = $googleAuthenticator->getQRCodeGoogleUrl('Blog', $secret);
echo "Google Charts URL for the QR-Code: ".$qrCodeUrl."\n\n";

$oneCode = $googleAuthenticator->getCode($secret);
echo "Checking Code '$oneCode' and Secret '$secret':\n";

$checkResult = $googleAuthenticator->verifyCode($secret, $oneCode, 2);    // 2 = 2*30sec clock tolerance
if ($checkResult) {
    echo 'OK';
} else {
    echo 'FAILED';
}
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Security

If you discover any security-related issues, please email [hoangphidev@gmail.com](mailto:hoangphidev@gmail.com) instead of using the issue tracker.

## Credits

- [Phi Hoang](https://github.com/hoangphidev)
- [All Contributors](../../contributors)

## References

- [Google Authenticator PHP class](https://github.com/PHPGangsta/GoogleAuthenticator)

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
