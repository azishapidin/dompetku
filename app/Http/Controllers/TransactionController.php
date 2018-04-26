<?php

namespace App\Http\Controllers;

use App\Model\Account;
use Illuminate\Http\Request;

/**
 * Route Handler for Transaction.
 *
 * @author  Azis Hapidin <azishapidin@gmail.com>
 *
 * @link    https://azishapidin.com/
 */
class TransactionController extends Controller
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
     * Create Transaction.
     *
     * @param int $accountId Account ID
     *
     * @return \Illuminate\View\View
     */
    public function create($accountId = 0)
    {
        $account = Account::withTrashed()->findOrFail($accountId);
        if ($account->user_id != $this->request->user()->id) {
            abort(403);
        }

        return view('transaction.create', [
            'account' => $account,
        ]);
    }
}
