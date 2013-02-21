Slender-CMS
===========

Setup
====

Update our composer.json with:
```
{
  "require": {
        "engoyan/slender-cms": "*"
	},
  ...
}
```

Run composer:
```
php composer.phar --verbose install
```

Run arisan command to pusblish config and static files for CMS:
```
php artisan asset:publish "dws/slender-cms"
```

Update Laravel Service Providers and add next: 

```
...
'Dws\SlenderCMS\ApiServiceProvider',
'Dws\SlenderCMS\Auth\ApiAuthServiceProvider',
'Dws\SlenderCMS\SlenderCMSServiceProvider',
...
```

Note
====
This is temporary home for Slender CMS. Soon it will be moved to:
```
https://github.com/dwsla/slender-cms
```
