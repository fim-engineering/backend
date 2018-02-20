<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App;

class HomePageController extends Controller
{
    public function index()
    {
      $user = User::all();
      return view('welcome');
    }
}
