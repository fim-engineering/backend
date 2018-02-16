<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
      $this->middleware('auth:api']);
  }

    public function index()
    {
      $user = use App\User;

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
