<?php

namespace App\Http\Controllers\RouteHandler;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStore;
use App\Model\TransactionCategory;
use Illuminate\Http\Request;

/**
 * Route Handler for Transaction Category.
 *
 * @author  Azis Hapidin <azishapidin@gmail.com>
 *
 * @link    https://azishapidin.com/
 */
class CategoryController extends Controller
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
     * Show all user transaction category.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data['categories'] = $this->request->user()->categories()->paginate();

        return view('category.index', $data);
    }

    /**
     * Show form for create category.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = TransactionCategory::all();

        return view('category.create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store Category to Database.
     *
     * @param \App\Http\Requests\CategoryStore $request Request from User after Validation
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryStore $request)
    {
        $posted = $request->except(['_token', '_method']);
        $posted['user_id'] = $request->user()->id;
        TransactionCategory::create($posted);

        return redirect()->route('category.index');
    }

    /**
     * Show edit form.
     *
     * @param \App\Model\TransactionCategory $category Category Model
     *
     * @return \Illuminate\View\View
     */
    public function edit(TransactionCategory $category)
    {
        $categories = TransactionCategory::all();
        if ($category->user_id != $this->request->user()->id) {
            abort(403);
        }

        return view('category.edit', [
            'category'      => $category,
            'categories'    => $categories,
        ]);
    }

    /**
     * Update to Database.
     *
     * @param \App\Model\TransactionCategory   $category Category Model
     * @param \App\Http\Requests\CategoryStore $request  Request from User after Validation
     *
     * @return \Illuminate\Http\Response
     */
    public function update(TransactionCategory $category, CategoryStore $request)
    {
        if ($category->user_id != $this->request->user()->id) {
            abort(403);
        }
        $posted = $request->except(['_token', '_method']);
        $category->update($posted);

        return redirect()->route('category.edit', $category->id);
    }
}
