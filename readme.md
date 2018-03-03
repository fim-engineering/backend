



# Documentation API Portal FIM <img src="https://laravel.com/assets/img/components/logo-laravel.svg">



1. [Saya mendaftar untuk menjadi kader FIM Nextgen di Regional pilih dari dropdown list nama-nama regional](#index-list-for-select-form--get)

   ​

2. [DATA DIRI : Data diri sesuai KTP + riwayat penyakit dan alergi + golongan darah + nama institusi/angkatan/jurusan + kontak yang bisa dihubungin + sosmed + scan KTP + Pas foto (atau foto dengan latar 1 warna)](#update-profile)

   ​

3. Aktivitas dan Kepribadian

- [3 Aktivitas terbaik (sesuai format form FIM yg lalu)](#achievement_best-for-participant)

- [MBTI](#update-personality) | column "mbti" | untuk pilihannya ["/api/select/mbtis"](#index-list-for-select-form--get)

- [Kelebihan diri](#update-personality) | column "strength"

- [Kekurangan diri](#update-personality) | column "weakness"

- [Self Assessment dalam organisasi (performance paling baik pada saat di) : kepengurusan/kepanitiaan/keduanya sama baiknya](#update-personality) | [Link API Select "best_performance"](#index-list-for-select-form--get)

- 5 Pilar FIM assesment (cintakasih, integritas, dll) | [column "pilar"](#update-personality)

  ​

1. Tentang aku dan FIM

- [sumber informasi tentang FIM](#update-me-and-fim) | [Select Form "Fim-Reference"](#index-list-for-select-form--get)

- [motivasi/ceritakan kenapa ingin ikut FIM](#update-me-and-fim)

- [skill/ sumberdaya apa yang bisa dikontribusikan ke FIM](#update-me-and-fim)

- [bakat apa yang bisa ditampilkan pada saat api ekspresi pelatihan FIM?](#update-me-and-fim)

  ​

1. Informasi tambahan

- Sebutkan 3 tokoh idola Anda yang cocok menjadi pemimpin Indonesia masa depan | [tabel pada personality "role_model"](#update-personality)
- Sebutkan 3 masalah anak muda yang paling krusial untuk diatasi saat ini di Indonesia | [tabel pada personality "problem_solver"](#update-personality)

  **CEK STATUS**

- Mengecek Status Apakah semua sudah terisi atau belum
- Konfirmasi bahwa semua sudah final

### Select Table Database

------



##### Index-List-for-Select-Form | GET

```
/api/admin/regionals
/api/select/mbtis
/api/select/fim-references
/api/select/best-performances
/api/select/positions
/api/institution-list
```

- Header : Content-Type (application/json), Accept (application/json), Authorization (Bearer <token>)

### Authorization

------



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





## Profile

------

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
	"regional_id":"regional_id"
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

------

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



### Achievement for participant (DRAFTED)

------

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
		"achievement": "string",
		"date_from" : "format Y-m-d",
		"date_end" : "format Y-m-d",
		"position_name" : "string",
		"phone_leader" : "string",
		"email_leader" :	"string",
		"description" :	"text",
		"is_ready" :	"integer"
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



#### Update Achievement

```
/api/achievement/{id}/update| PUT





```

- Header : Content-Type (application/json), Accept (application/json), Authorization (Bearer <token>)
- Body :

```
{
	"achievement": "string",
	"date_from": "format Y-m-d",
	"date_end": "format Y-m-d",
	"position_name": "string",
	"phone_leader": "string",
	"email_leader":	"string",
	"description":	"text",
	"is_ready":	"integer"
}





```

- Return :

```
{
	'Updated' :Updated,
	'code': 200,
}





```



#### Delete Achievement

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



### Achievement_best for participant

------

#### Index List Achievement_best (One to One)

```
/api/achievementbest| GET





```

- Header : Content-Type (application/json), Accept (application/json), Authorization (Bearer <token>)
- Body :

```
-





```

- Return :

```
{  
	"achievement" : $achievement or "Null data try to update data",
	"code":  200,
}





```



#### Update Achievement_best(NEW)

```
/api/achievementbest/update| POST





```

- Header : Content-Type (application/json), Accept (application/json), Authorization (Bearer <token>)
- Body :

```
{
		"is_ready" :	"integer",

		"achievement": "string",
		"date_from" : "format Y-m-d",
		"date_end" : "format Y-m-d",
		"position_name" : "string",
		"phone_leader" : "string",
		"email_leader" :	"string",
		"description" :	"text",


		"achievement_2": "string",
		"date_from_2" : "format Y-m-d",
		"date_end_2" : "format Y-m-d",
		"position_name_2" : "string",
		"phone_leader_2" : "string",
		"email_leader_2" :	"string",
		"description_2" :	"text",

		"achievement_3": "string",
		"date_from_3" : "format Y-m-d",
		"date_end_3" : "format Y-m-d",
		"position_name_3" : "string",
		"phone_leader_3" : "string",
		"email_leader_3" :	"string",
		"description_3" :	"text",
}





```

- Return :

```
{  
		'achievement_best' = $achievement_best,
		'message'='Success ! Achievements Updated',
		'code'= 200,
}





```





### Personality for participant

------

#### Index Personality (One to One)

```
/api/personality| GET





```

- Header : Content-Type (application/json), Accept (application/json), Authorization (Bearer <token>)
- Body :

```
-





```

- Return :

```
{  
	"personality" : $personality,
	"code":  200,
}





```



#### Update Personality

```
/api/personality/update| PUT





```

- Header : Content-Type (application/json), Accept (application/json), Authorization (Bearer <token>)
- Body :

```
{
	"mbti" : string,
	"mbti_type" : mbti_id | list ada di API mbti,
	"best_performance" : string,
	"best_performance_id" : best_performance_id | list ada di API best_performance,
	"strength" : text,
	"weakness" : text,
	"cintakasih" : integer,
	"integritas" : integer,
	"kebersahajaan" : integer,
	"totalitas" : integer,
	"solidaritas" : integer,
	"keadilan" : integer,
	"keteladanan" : integer,
	"is_ready" : integer,

	"role_model" : text,
	"role_model_2" : text,
	"role_model_3" : text,


	"problem_solver" : text,
	"problem_solver_2" : text,
	"problem_solver_3" : text,

}





```

- Return :

### Me And FIM for participant

------

#### Index me and fim (One to One)

```
/api/meforfim | GET





```

- Header : Content-Type (application/json), Accept (application/json), Authorization (Bearer <token>)
- Body :

```
-





```

- Return :

```
{  
	fim_reference	: "string" | List ada di API (section atas)
	why_join_fim	: "Text"
	skill_for_fim 	: "Text"
	performance_apiekspresi:
	is_ready		: "integer"
}





```



#### Update me and fim

```
/api/meforfim/update| PUT

```

- Header : Content-Type (application/json), Accept (application/json), Authorization (Bearer <token>)
- Body :

```
{
	"fim_reference"	: "string" | List ada di API (section atas),
	"why_join_fim"	: "Text",
	"skill_for_fim" : "Text",
	"performance_apiekspresi": "Text",
	"is_ready"		: "0"
}

```

- Return :

```
{  
		'meandfim' : $meandfim,
        'message' :'Success ! The me-and-fim data Updated',
        'code'=> 200,
}

```



### Status Check

------

#### Cek Status Final atau belum

```
/api/final-submit/status| GET

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
	"status_profile": 0,
    "status_achievement": "xxx (Artinya belum pernah diisi sama sekali)",
    "status_personality": 1 (Artinya Final),
    "status_meandfim": "xxx (Artinya belum pernah diisi sama sekali)",
    "final": 0 (Belum Final) | 1 (Super Final),
}

```



#### Membuat Semua jadi Final

```
/api/final-submit/confirm| POST

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
	"message": "Data Updated",
    "code": 200,
}

```



#### Membuat Semua jadi Belum Final

```
/api/final-submit/confirm/revert | POST

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
	"message": "Data Reverted",
    "code": 200,
}
```



#### Cek Masing Masing Bagian yang belum Keisi

```
/api/check-status/profile | GET
/api/check-status/achievement | GET
/api/check-status/personality | GET
/api/check-status/meandfim | GET

```

- Header : Content-Type (application/json), Accept (application/json), Authorization (Bearer <token>)
- Return :

```
{
	Jumlah Null :
	Pesan detail yang belum terisi
	Status True (Jika sudah penuh data) atau False (Jika data belum penuh)
}


```



#### Lupa Password

```
/api/forgot-password | POST

```

- Header : Content-Type (application/json), Accept (application/json)
- Body :

```
{
	email : "email"
}


```

- Return :

  ```
  'status' :"E-mail Sent",
  'code' : 200
  ```

  ​
