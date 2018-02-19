<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class HomePageController extends Controller
{
    public function index()
    {
      $user = User::all();      
      return view('welcome');
    }
}
