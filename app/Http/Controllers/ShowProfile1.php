<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class ShowProfile1 extends Controller
{
    public function login1() {
        // echo "login";
        // exit;
        $users = DB::table('members')->get();

        echo "<pre>";print_r($users);
    }

}
