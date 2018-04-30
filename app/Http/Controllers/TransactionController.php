<?php

namespace App\Http\Controllers;

use App\Model\Account;
use Illuminate\Http\Request;
use App\Http\Requests\TransactionStore;
use App\Http\Controllers\Module\TransactionBuilder;

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

    /**
     * Store transaction to database.
     * 
     * 
     */
    public function store(TransactionStore $request, $accountId = 0)
    {
        $account = Account::withTrashed()->findOrFail($accountId);
        $posted = $request->except(['_token', '_method']);

        $builder = new TransactionBuilder($account);
        if ($posted['type'] == 'cr') {
            $builder->addCredit($posted['amount']);
        } elseif ($posted['type'] == 'db') {
            $builder->addDebit($posted['amount']);
        }
        $builder->setDescription($posted['description']);
        $builder->setDate($posted['date']);
        $builder->save();

        return redirect()->route('account.show', $account->id);
    }
}
