<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountStore;
use App\Model\Account;
use Illuminate\Http\Request;

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
     * Show list Account.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data['showDeleted'] = false;
        if ($this->request->get('show') == 'trash') {
            $data['showDeleted'] = true;
        }

        if ($data['showDeleted']) {
            $data['accounts'] = $this->request->user()->deletedAccounts();
        } else {
            $data['accounts'] = $this->request->user()->accounts;
        }

        return view('account.index', $data);
    }

    /**
     * Show form for create Account.
     *
     * @return \Illuminate\View\View
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
     *
     * @return \Illuminate\Http\Response
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

    /**
     * Show edit form.
     *
     * @param \App\Model\Account $account Account Model
     *
     * @return \Illuminate\View\View
     */
    public function edit(Account $account)
    {
        $currencies = config('currency');
        if ($account->user_id != $this->request->user()->id) {
            abort(403);
        }

        return view('account.edit', [
            'account'    => $account,
            'currencies' => $currencies,
        ]);
    }

    /**
     * Store Account to Database.
     *
     * @param \App\Http\Requests\AccountStore $request Request from User after Validation
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Account $account, AccountStore $request)
    {
        if ($account->user_id != $this->request->user()->id) {
            abort(403);
        }
        $posted = $request->except(['_token', '_method']);
        $update = $account->update($posted);

        return redirect()->route('account.edit', $account->id);
    }

    /**
     * Softdelete Account.
     *
     * @param \App\Model\Account $account Account Model
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        if ($account->user_id != $this->request->user()->id) {
            abort(403);
        }
        $account->delete();

        return redirect()->route('account.index');
    }

    /**
     * Restore Account, set deleted_at to null.
     *
     * @param \App\Model\Account $account Account Model
     *
     * @return \Illuminate\Http\Response
     */
    public function restore(Account $account)
    {
        if ($account->user_id != $this->request->user()->id) {
            abort(403);
        }

        // restore
    }

    /**
     * Permanenty delete from database.
     *
     * @param \App\Model\Account $account Account Model
     *
     * @return \Illuminate\Http\Response
     */
    public function deletePermanent(Account $account)
    {
        if ($account->user_id != $this->request->user()->id) {
            abort(403);
        }

        // delete
    }
}
