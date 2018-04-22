<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountStore;
use Illuminate\Http\Request;
use App\Model\Account;

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
     * Class Constructor
     * 
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show list Account
     * 
     * @param \Illuminate\Http\Request $request User Request
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $accounts = $request->user()->accounts;
        
        return view('account.index', [
            'accounts' => $accounts,
        ]);
    }

    /**
     * Show form for create Account.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currencies = config('currency');

        return view('account.create', [
            'currencies' => $currencies,
        ]);
    }

    /**
     * Store Account to Database.
     *
     * @param \App\Http\Requests\AccountStore $request Request from User after Validation
     */
    public function store(AccountStore $request)
    {
        $posted = $request->except(['_token', '_method']);
        if (!is_null($request->file('image'))) {
            $fileName = $request->user()->id.'+'.md5(time());
            $extension = $request->file('image')->getClientOriginalExtension();
            $path = $request->file('image')->storeAs(
                config('account.image_path'), $fileName.'.'.$extension, 'public'
            );
            $posted['image'] = $path;
        }
        $posted['user_id'] = $request->user()->id;

        $account = Account::create($posted);

        return redirect()->route('account.index');
    }
}
