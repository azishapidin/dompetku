<?php

namespace App\Http\Controllers\RouteHandler;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Route Handler for Dashboard.
 *
 * @author  Azis Hapidin <azishapidin@gmail.com>
 *
 * @link    https://azishapidin.com/
 */
class HomeController extends Controller
{
    /**
     * Set Request POST / GET to Global.
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * Class Constructor.
     *
     * @param \Illuminate\Http\Request $request User Request
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = [];
        // $this->request->user()->accounts()->distinct('currency')->get(['currency'])
        //      ->pluck('currency')->each(function($currency) use($data) {
        //         $data['balance_by_currency'][$currency] = $this->request->user()->accounts()->where('currency', $currency)->sum('balance');
        //      });

        $data['account_count'] = $this->request->user()->accounts()->count();
        $data['transaction_count'] = $this->request->user()->transactions()->count();
        $data['credit_count'] = $this->request->user()->transactions()->where('type', 'cr')->count();
        $data['debit_count'] = $this->request->user()->transactions()->where('type', 'db')->count();

        return view('home', $data);
    }
}
