<?php

namespace App\Http\Controllers;

/**
 * Route Handler for Account.
 *
 * @author  Azis Hapidin <azishapidin@gmail.com>
 *
 * @link    https://azishapidin.com/
 */
class AccountController extends Controller
{
    /**
     * Class Constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show form for create Account.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('account.create');
    }
}
