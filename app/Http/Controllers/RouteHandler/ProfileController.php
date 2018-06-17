<?php

namespace App\Http\Controllers\RouteHandler;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Controller for hanling user profile page.
 *
 * @author  Azis Hapidin <azishapidin@gmail.com>
 *
 * @link    https://azishapidin.com/
 */
class ProfileController extends Controller
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
     * Show user profile
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data['user'] = $this->request->user();

        return view('profile.index', $data);
    }
}
