<?php
/**
 * Created by PhpStorm.
 * User: smirnoff
 * Date: 17.10.18
 * Time: 11:03
 */

namespace Admin\Http\Controllers;
use SleepingOwl\Admin\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthController extends AdminController
{
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('login');
    }
}