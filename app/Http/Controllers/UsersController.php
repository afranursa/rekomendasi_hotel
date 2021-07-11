<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;
use App\Model\Users;
use Exception;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
    public function loginIndex() {
        return \view('admin.login');
    }
}
