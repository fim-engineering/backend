<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Documentation

### Sign Up
```
/api/signup | POST
```
- Header : Content-Type (application/json), Accept (application/json)
- Body :
```
{
	"email":"email",
	"password":"password"
}
```
- ** Return ** :
```
{
  {
    "token": {
        "headers": {},
        "original": {
            "access_token": "TOKEN",
            "token_type": "bearer",
            "expires_in": 3600
        },
        "exception": null
    },
    "user": {
        "id": ID USER,
        "name": "NULL NAME",
        "username": "NULL USERNAME",
        "email": "EMAIL",
        "created_at": "DATETIME",
        "updated_at": "DATETIME",
        "deleted_at":
    }
  }
}
```

### Log In
```
/api/signup | POST
```
- Header : Content-Type (application/json), Accept (application/json)
- Body :
```
{
	"email":"email",
	"password":"password"
}
```
- ** Return ** :
```
{
    "token": {
        "headers": {},
        "original": {
            "access_token": "TOKEN",
            "token_type": "bearer",
            "expires_in": 3600
        },
        "exception": null
    },
    "user": {
        "id": ID,
        "name": NULL NAME,
        "username": NULL USERNAME,
        "email": "EMAIL",
        "created_at": "DATETIME",
        "updated_at": "DATETIME",
        "deleted_at": null
    }
}
```
