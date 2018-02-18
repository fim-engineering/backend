<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

# Documentation

### Authorization

#### Sign Up
```
/api/signup | POST
```
- Header : Content-Type (application/json), Accept (application/json)
- Body :
```
{
	"name":"full name"
	"email":"e-mail",
	"password":"password"
}
```
- Return :
```
{  
    "message": 'Successfully Create an Account';  
}
```

#### Activate
```
/api/activate | POST
```
- Header : Content-Type (application/json), Accept (application/json)
- Body :
```
{
	"email":"e-mail",
	"unique_code":"6 digit random number"
}
```
- Return :
```
{  
	if(already activated or valid code)
		"message": 'Successfully Activated',
		"account_status": 1,
		"account": 'account',

	if(invalid)
		"message": 'Successfully Activated',
		"account_status": 0 (invalid / inactive);
}
```

#### Log In
```
/api/login | POST
```
- Header : Content-Type (application/json), Accept (application/json)
- Body :
```
{
	"email":"email",
	"password":"password"
}
```
- Return :
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
		"account_status": (status)
}
```

#### Log Out
```
/api/logout | POST
```
- Header : Content-Type (application/json), Accept (application/json), Authorization (Bearer <token>)
- Body : -
- Return :
```
{
    "Message": 'Successfully logged out',
}
```
