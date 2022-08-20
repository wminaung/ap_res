<?php

namespace App\Http\Controllers;


use App\Models\Dish;
use App\Models\Order;
use App\Models\Table;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $dishes = Dish::orderBy('id', 'desc')->get();
        $tables = Table::all();

        $status = config('res.order_status');
        $status = array_flip($status);
        $orders =  Order::where('status', 4)->get();

        return view('order_form', compact('dishes', 'tables', 'orders', 'status'));
    }


    public function submit(Request $request)
    {
        $data = array_filter($request->except('_token', 'table'));
        $orderId = rand();

        //dd($request->all());
        foreach ($data as $key => $value) {


            if ($value > 1) {
                for ($i = 1; $i <= $value; $i++) {
                    $this->saveOrder($orderId, $key, $request);
                }
            } else {
                $this->saveOrder($orderId, $key, $request);
            }
        }
        return redirect('/')->with('message', "Order Submitted");
    }

    public  function saveOrder($orderId, $dish_id, $request)
    {

        $order = new Order();
        $order->order_id = $orderId;
        $order->dish_id = $dish_id;
        $order->table_id = $request->table;
        $order->status  = config('res.order_status.new');
        $order->save();
    }

    public function serve(Order $order)
    {
        $order->status = config('res.order_status.done');
        $order->save();
        return redirect('/')->with('message', 'Order Serve to customer');
    }
}
