<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Company;
use App\Product;
use App\Order;
use App\OrderItem;
use Auth;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->create();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::getCompaniesToSelectComponent();
        $products = Product::select('id','name')->get();

        return view('admin.orders.create', compact('companies','products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = new Order;
        $order->company_id = $request->company_id;
        $order->user_id = Auth::id();

        $order->save();

        $orderID = $order->id;
        
        $products = json_decode($request->products);
        foreach ($products as $product) {
            $orderItem = new OrderItem;
            $orderItem->order_id = $orderID;
            $orderItem->product_id = $product->id;
            $orderItem->quantity = $product->quantity;

            $orderItem->save();
        }

        return redirect()->back()->with('message', 'Order created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::find($id);
        
        $orders = $company->orders();
        $orderItems = $orders->with('orderItems')->get();
        
        foreach ($orderItems as $key => $itemOrder) {
            foreach ($itemOrder->orderItems as $keyItem => $item) {
                $products = ($item->products()) ? $item->products()->get() : [];

                $itemOrder->orderItems[$keyItem]['products'] = $products;
            }
        }

        $orders = $orderItems;

        $company = $orders[0]->company;

        return view('admin.orders.edit', compact('company', 'orders'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        Order::find($id)->update($data);

        return redirect()->back()->with('message', 'Order updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
