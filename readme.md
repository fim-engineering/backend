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
Aktivasi menggunakan skema memasukkan kode yang digenerate secara acak sebanyak 6 digit yang dikirim via email.
Jika kode yang dimasukan benar maka tabel 'active' akan berubah menjadi 1

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
		"message": 'Code or email not Valid, Failed to Activate',
		"account_status": 0 (invalid / inactive);
}
```

#### Resend Email Verification
```
/api/resend | POST
```
- Header : Content-Type (application/json), Accept (application/json)
- Body :
```
{
	"email":"e-mail",
}
```
- Return :
```
{  
	'message':'Successfully Processing Resend Verification Email',
	'code': 200,
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
		"account_status": (1 = activated | 0 = not activated)
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

#### Change Password
```
/api/change-password | POST
```
- Header : Content-Type (application/json), Accept (application/json), Authorization (Bearer <token>)
- Body :
```
{
	"old_password":'string'
	"new_password":'string'
	"new1_password":'strint'

}
```
- Return :
```
//  if new & new1 password didn't match
{
	'message':"Your New Password Didn't Match",
	'code': 304,
}

// if old password match in database
{
	'message' => "Password has been changed",
	'code' => 200,
}

// else
{
	'message': "Please Try Again",
	'code':401,
}
```


### Profile


### index profile
```
/api/myprofile | GET
```
- Header : Content-Type (application/json), Accept (application/json), Authorization (Bearer <token>)
- Body : -
- Return :

```
{
	{
    "user_profile": {
        "id": 4,
        "user_id": 8,
        "full_name": "Bagus Dwi Utama",
				"institution": "null",
				"majors":"null",
				"generation":"null",
        "address": null,
        "city": null,
        "phone": null,
        "gender": null,
        "photo_profile_link": null,
        "ktp_link": null,
        "blood": null,
        "born_date": null,
        "born_city": null,
        "marriage_status": null,
        "address_format": null,
        "facebook": null,
        "instagram": null,
        "blog": null,
        "line": null,
        "disease_history": null,
        "video_profile": null,
        "religion": null,
        "is_ready": 0 notyet/1 ready,
        "created_at": "datetime",
        "updated_at": "datetime",
        "deleted_at": null
    },
}
```

#### Update Profile
```
/api/myprofile/update | PUT
```
- Header : Content-Type (application/json), Accept (application/json), Authorization (Bearer <token>)
- Body :
```
{
	"full_name": string,
	"institution": "string",
	"majors":"string",
	"generation":"string",
	"address": text,
	"city": string,
	"phone": string,
	"gender": string,
	"photo_profile_link": string,
	"ktp_link": string,
	"blood": string,
	"born_date": datetime,
	"born_city": string,
	"marriage_status": integer = 1 (Sudah Menikah), 0 (Belum Menikah),
	"facebook": string,
	"instagram": string,
	"blog": string,
	"line": string,
	"disease_history": text (New list by New Line),
	"video_profile": string,
	"religion": string,
	"is_ready": 0 = belum | 1 = sudah,
}
```

- Return :
```
{
	'user_profile' : user_profile,
	'message':'Success ! Profile Updated',
	'code':200,
}
```

### Regionals for Admin

#### Index List Regionals
```
/api/admin/regionals| GET
```
- Header : Content-Type (application/json), Accept (application/json), Authorization (Bearer <token>)
- Body :
```
-
```
- Return :
```
{  
	'regionals' : $regional,
	'code' :  200,
}
```

#### Create List Regionals
```
/api/admin/regionals/create| POST
```
- Header : Content-Type (application/json), Accept (application/json), Authorization (Bearer <token>)
- Body :
```
{
	"regional_name": string
	"logo": string
	"id_google_calendar": string
	"address": string
	"city":string
	"user_id":integer
}
```
- Return :
```
{  
	"message" :  "Success",
	"regionals" : regional,
	"code" :  200,
}
```

#### Edit Regionals
```
/api/admin/regionals/edit| POST
```
- Header : Content-Type (application/json), Accept (application/json), Authorization (Bearer <token>)
- Body :
```
{
	"regional_id": integer
}
```
- Return :
```
{  	
	"regionals" : regional,
	"code" :  200,
}
```


#### Update Regionals
```
/api/admin/regionals/update| PUT
```
- Header : Content-Type (application/json), Accept (application/json), Authorization (Bearer <token>)
- Body :
```
{
	"regional_id":integer,
	"regional_name": string,
	"logo": string,
	"id_google_calendar": string,
	"address": string,
	"city":string,
	"user_id":integer
}
```
- Return :
```
{
	"message": "updated",
	"regionals" : regional,
	"code" :  200,
}
```

#### Delete Regionals
```
/api/admin/regionals/delete| POST
```
- Header : Content-Type (application/json), Accept (application/json), Authorization (Bearer <token>)
- Body :
```
{
	"regional_id":integer,
}
```
- Return :
```
{
	"message": "deleted",
	"code" :  200,
}
```

#### Institution List
```
/api/institution-list | GET
```
- Header : Content-Type (application/json), Accept (application/json))
- Return :
```
{
	"list kampus" (distincted);
}
```



### Achievement for participant

#### Index List Achievement (One to Many)
```
/api/achievement| GET
```
- Header : Content-Type (application/json), Accept (application/json), Authorization (Bearer <token>)
- Body :
```
-
```
- Return :
```
{  
	"achievement" : $achievement,
	"code":  200,
}
```

#### Create List of Achievement
```
/api/achievement/create| POST
```
- Header : Content-Type (application/json), Accept (application/json), Authorization (Bearer <token>)
- Body :
```
{
		"achievement"		: "string",
		"date_from"			: "format Y-m-d",
		"date_end"			: "format Y-m-d",
		"position_name"	: "string",
		"phone_leader"	: "string",
		"email_leader"	:	"string",
		"description"		:	"text",
		"is_ready"			:	"integer"
}
```
- Return :
```
{  
		'user_achievements' = $user_achievements,
		'message'='Success ! Achievements Added',
		'code'= 200,
}
```

#### Edit One Achievement
```
/achievement/'+id_achievement+'/edit| GET
```
- Header : Content-Type (application/json), Accept (application/json), Authorization (Bearer <token>)
- Return :
```
{  	
	'user_achievements' =>$id,
	'code'=> 200,
}
```


#### Update Regionals
```
/api/achievement/{id}/update| PUT
```
- Header : Content-Type (application/json), Accept (application/json), Authorization (Bearer <token>)
- Body :
```
{
	"achievement"		: "string",
	"date_from"			: "format Y-m-d",
	"date_end"			: "format Y-m-d",
	"position_name"	: "string",
	"phone_leader"	: "string",
	"email_leader"	:	"string",
	"description"		:	"text",
	"is_ready"			:	"integer"
}
```
- Return :
```
{
	'Updated' :Updated,
	'code': 200,
}
```

#### Delete Regionals
```
/api/achievement/'+id_achievement+'/delete| POST
```
- Header : Content-Type (application/json), Accept (application/json), Authorization (Bearer <token>)
- Body :
```
{
	-
}
```
- Return :
```
{
	"message": 'Achievement Deleted',
	"code":  200,
}
```
