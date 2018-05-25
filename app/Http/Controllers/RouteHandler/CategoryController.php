<?php

namespace App\Http\Controllers\RouteHandler;

use App\Http\Controllers\Controller;
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
     * Show all transaction category.
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        
    }
}
