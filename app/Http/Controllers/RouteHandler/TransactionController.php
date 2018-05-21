<?php

namespace App\Http\Controllers\RouteHandler;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Module\TransactionBuilder;
use App\Http\Requests\TransactionStore;
use App\Model\Account;
use App\Model\Transaction;
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
     * Show all user transaction.
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = $this->request->user();
        $data['transactions'] = $user->transactions()->orderBy('id', 'desc')->paginate();

        return view('transaction.index', $data);
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
     * @param App\Http\Requests\TransactionStore $request   Request from User after Validation
     * @param int                                $accountId Account ID
     *
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionStore $request, $accountId = 0)
    {
        $account = Account::withTrashed()->findOrFail($accountId);
        if ($account->user_id != $this->request->user()->id) {
            abort(403);
        }
        $posted = $request->except(['_token', '_method']);

        $builder = new TransactionBuilder($account);
        if ($posted['type'] == 'cr') {
            $builder->addCredit($posted['amount']);
        } elseif ($posted['type'] == 'db') {
            $builder->addDebit($posted['amount']);
        }
        if (isset($posted['attachment']) && count($posted['attachment']) > 0) {
            $builder->attachFile($posted['attachment']);
        }
        $builder->setDescription($posted['description']);
        $builder->setDate($posted['date']);
        $builder->save();

        return redirect()->route('account.show', $account->id);
    }

    /**
     * Show detail transaction.
     * 
     * @param integer $transactionId Transaction ID
     * 
     * @return \Illuminate\View\View
     */
    public function detail($transactionId = 0)
    {
        $transaction = Transaction::findOrFail($transactionId);
        if ($transaction->user_id != $this->request->user()->id) {
            abort(403);
        }

        return view('transaction.detail', [
            'transaction' => $transaction,
        ]);
    }
}
