<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $f_list_meta_title = auth()->user()->first_name . trans('lang.dashboard');
        $f_list_meta_desc = $f_list_meta_title;
        $show_f_banner = true;
        $f_inner_banner = null;

        return view('front-end.users.index', compact('f_list_meta_title', 'f_list_meta_desc', 'show_f_banner', 'f_inner_banner'));
    }
}
