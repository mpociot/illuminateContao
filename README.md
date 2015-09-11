IlluminateContao
================
Use Laravel classes in Contao CMS (WIP)

## Installation via Composer
``` bash
$ composer require mpociot/illuminate-contao
```

## Usage

### Validation

**Important**
You need to copy the [validation.php](https://github.com/laravel/laravel/blob/v4.2.11/app/lang/en/validation.php) into this Contao directory:

`TL_ROOT /system/lang/en/validation.php`

```php
use Mpociot\IlluminateContao\Validator;
$validator = Validator::make([], [
	"ean" => "required"
]);
if( $validator->fails() )
{
	$errors = $validator->errors();
}
```

### Eloquent / Database
```php
<?php
use Mpociot\IlluminateContao\EncapsulatedEloquentBase;

class UserProfile extends EncapsulatedEloquentBase
{

	protected $table = "user_profile";

	public function user()
	{
		return $this->belongsTo('User');
	}

}

```

#### Running Tests
``` bash
$ composer test
```


#### License
This library is licensed under the MIT license. Please see [License file](LICENSE.md) for more information.
