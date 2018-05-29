<?php

namespace App\Http\Controllers\RouteHandler;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Module\TransactionBuilder;
use App\Http\Requests\TransactionStore;
use App\Http\Requests\TransactionUpdate;
use App\Model\Account;
use App\Model\Transaction;
use App\Model\TransactionCategory;
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
        $categories = TransactionCategory::all();
        if ($account->user_id != $this->request->user()->id) {
            abort(403);
        }

        return view('transaction.create', [
            'account'       => $account,
            'categories'    => $categories,
        ]);
    }

    /**
     * Edit transaction form.
     *
     * @param int $transactionId Transaction ID
     *
     * @return \Illuminate\View\View
     */
    public function edit($transactionId = 0)
    {
        $transaction = Transaction::withTrashed()->findOrFail($transactionId);
        $categories = TransactionCategory::all();
        if ($transaction->user_id != $this->request->user()->id) {
            abort(403);
        }

        return view('transaction.edit', [
            'transaction'   => $transaction,
            'account'       => $transaction->account,
            'categories'    => $categories,
        ]);
    }

    /**
     * Update transaction.
     *
     * @param App\Http\Requests\TransactionUpdate   $request        Request from User after Validation
     * @param int                                   $transactionId  Transaction ID
     *
     * @return \Illuminate\Http\Response
     */
    public function update(TransactionUpdate $request, $transactionId = 0)
    {
        $transaction = Transaction::findOrFail($transactionId);
        if ($transaction->user_id != $this->request->user()->id) {
            abort(403);
        }

        $fields = [
            'date', 'category_id', 'description'
        ];

        $posted = $request->only($fields);
        $transaction->update($posted);

        return redirect(route('account.show', $transaction->account_id));
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
        if (isset($posted['category_id']) && !is_null($posted['category_id'])) {
            $builder->setCategory($posted['category_id']);
        }
        $builder->setDescription($posted['description']);
        $builder->setDate($posted['date']);
        $builder->save();

        return redirect()->route('account.show', $account->id);
    }

    /**
     * Show detail transaction.
     *
     * @param int $transactionId Transaction ID
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
