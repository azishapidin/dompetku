<?php

namespace App\Http\Controllers\RouteHandler;

use App\Http\Controllers\Controller;
use App\Model\TransactionCategory;
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
        $lava = new \Khill\Lavacharts\Lavacharts;
        $transactionCounter = $lava->DataTable();

        $data['account_count'] = $this->request->user()->accounts()->count();
        $data['transaction_count'] = $this->request->user()->transactions()->count();
        $data['credit_count'] = $this->request->user()->transactions()->where('type', 'cr')->count();
        $data['debit_count'] = $this->request->user()->transactions()->where('type', 'db')->count();

        // Transaction type counter
        $transactionCounter->addStringColumn(__('Transaction Type'))
                ->addNumberColumn(__('Counter'))
                ->addRow([__('Credit'), $data['credit_count']])
                ->addRow([__('Debit'), $data['debit_count']]);

        $lava->PieChart('TypeCounter', $transactionCounter, [
            'title'  => __('Transaction Counter'),
            'is3D'   => false,
        ]);

        // Transaction category counter
        $categories = TransactionCategory::doesntHave('parent')
                                        ->where('user_id', $this->request->user()->id)
                                        ->where('show_on_stats', 1)
                                        ->get();
        foreach ($categories as $category) {
            if ($category->child()->count() == 0) {
                $categoryCounter[] = [
                    'name'  => $category->name,
                    'total' => $category->transactions()->sum('amount'),
                ];
            } else {
                $total = 0;
                $childs = $category->child()->where('show_on_stats', 1)->get();
                foreach ($childs as $child) {
                    $total += $child->transactions()->sum('amount');
                }
                $categoryCounter[] = [
                    'name'  => $category->name,
                    'total' => $total,
                ];
            }
            
        }

        $categoryChart = $lava->DataTable();
        $categoryChart->addStringColumn(__('Category Name'))->addNumberColumn(__('Total'));
        foreach ($categoryCounter as $counter) {
            if ($counter['total'] == 0) {
                continue;
            }
            $categoryChart->addRow([$counter['name'], $counter['total']]);
        }

        $lava->BarChart('CategoryCounter', $categoryChart);

        // Pass all chart data to view
        $data['lava'] = $lava;

        return view('home', $data);
    }
}
