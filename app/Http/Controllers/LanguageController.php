<?php

namespace App\Http\Controllers;

use Config;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

/**
 * Multilanguage App Controller
 * 
 * @author  Azis Hapidin <azishapidin@gmail.com>
 * @link    https://azishapidin.com/
 * 
 */
class LanguageController extends Controller
{
    /**
     * Switch active language to selected language
     * 
     * @param string $lang Language slug
     * 
     */
    public function switchLang($lang = 'id')
    {
        if (array_key_exists($lang, Config::get('languages'))) {
            Session::put('applocale', $lang);
        }
        
        return Redirect::back();
    }
}
