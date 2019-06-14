<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\PasswordHash;

class ConfirmController extends Controller
{

    public function index(Request $request)
    {
        $uid = $request->input('uid');
        $confirm = $request->input('confirm');
    }
}