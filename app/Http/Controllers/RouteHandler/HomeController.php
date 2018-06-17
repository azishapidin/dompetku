<?php

namespace App\Http\Controllers\RouteHandler;

use App\Http\Controllers\Controller;
use App\Model\TransactionCategory;
use Illuminate\Http\Request;
use Khill\Lavacharts\Lavacharts;

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
     * Set Lavachart Variable as Global.
     *
     * @var \Khill\Lavacharts\Lavacharts
     */
    protected $lava;

    /**
     * Set Data to view Variable as Global.
     *
     * @var array
     */
    protected $data;

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
        $this->lava = new Lavacharts();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['account_count'] = $this->request->user()->accounts()->count();
        $this->data['transaction_count'] = $this->request->user()->transactions()->count();
        $this->data['credit_count'] = $this->request->user()->transactions()->where('type', 'cr')->count();
        $this->data['debit_count'] = $this->request->user()->transactions()->where('type', 'db')->count();

        // Transaction type counter
        $this->countByType();

        // Transaction category counter
        $this->sumByTransactionCategory();

        // Pass all chart data to view
        $this->data['lava'] = $this->lava;

        return view('home', $this->data);
    }

    /**
     * Transaction counter by type (Credit or Debit).
     *
     * @return void
     */
    public function countByType()
    {
        $transactionCounter = $this->lava->DataTable();
        $transactionCounter->addStringColumn(__('Transaction Type'))
                ->addNumberColumn(__('Counter'))
                ->addRow([__('Credit'), $this->data['credit_count']])
                ->addRow([__('Debit'), $this->data['debit_count']]);

        $this->lava->PieChart('TypeCounter', $transactionCounter, [
            'title'  => __('Transaction Counter'),
            'is3D'   => true,
        ]);
    }

    /**
     * Sum all transaction by category.
     *
     * @return void
     */
    public function sumByTransactionCategory()
    {
        $categoryCounter = [];
        $categories = TransactionCategory::doesntHave('parent')
                                        ->where('user_id', $this->request->user()->id)
                                        ->where('show_on_stats', 1)
                                        ->get();

        foreach ($categories as $category) {
            $total = $category->transactions()->sum('amount');

            // Sum childs
            $childs = $category->child()->where('show_on_stats', 1)->get();
            foreach ($childs as $child) {
                $total += $child->transactions()->sum('amount');
            }

            $categoryCounter[] = [
                'name'  => $category->name,
                'total' => $total,
            ];
        }

        $categoryChart = $this->lava->DataTable();
        $categoryChart->addStringColumn(__('Category Name'))->addNumberColumn(__('Total'));
        foreach ($categoryCounter as $counter) {
            if ($counter['total'] == 0) {
                continue;
            }
            $categoryChart->addRow([$counter['name'], $counter['total']]);
        }

        $this->lava->BarChart('CategoryCounter', $categoryChart);
    }
}
