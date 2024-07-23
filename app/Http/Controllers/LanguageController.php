<?php

namespace App\Http\Controllers;

//use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    public function setLocale($lang){

        if(in_array($lang, ['en', 'fr', 'vi'])) {
            App::setLocale($lang);
            Session::put('locale', $lang);
        }
        return back();
    }
}
