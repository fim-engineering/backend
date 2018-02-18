<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;


class ProfilController extends Controller
{
  /**
   * Create a new AuthController instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth:api');
  }

    public function index()
    {
      $user = auth()->user()->id;

    }

    public function create()
    {
      # code...
    }

    public function update()
    {
      # code...
    }

    public function delete()
    {
      # code...
    }
}
