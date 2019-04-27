<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bill;
use DB;

class OrderController extends Controller
{
    public function index(){
    	$bills = DB::table('bill')
            ->join('user', 'user.id', '=', 'bill.id_user')
            ->select('bill.id', 'bill.created_at' , 'bill.total' , 'bill.status' , 'user.fullname' , 'user.email' , 'user.address')
            ->get();
    	return view('admin.pages.sale.order',[
    		'bills' => $bills
    	]);
    	
    }
    public function getOrder($id){
        $bill = DB::table('detail_bill')
            ->join('bill', 'detail_bill.id_bill', '=', 'bill.id')
            ->join('product', 'detail_bill.id_p','=','product.id')
            ->select('*')
            ->where('detail_bill.id_bill','=',$id)
            ->get();
        $inf = DB::table('bill')
        ->join('user', 'user.id', '=', 'bill.id_user')
        ->select('*')
        ->where('bill.id',$id)
        ->first();
        return view('admin.pages.sale.detail', [
            'bill' => $bill,
            'inf' => $inf,
            'id' => $id
        ]);
    }
    public function getInvoice($id){
        $bill = Bill::find($id);
        $bill->status = 1;
        $bill->save();
        return redirect()->route('order');
    }
    public function getShipping($id){
        $bill = Bill::find($id);
        $bill->status = 2;
        $bill->save();
        return redirect()->route('order');   
    }
}
