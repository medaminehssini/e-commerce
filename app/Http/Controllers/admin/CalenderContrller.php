<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Promotion;
use Illuminate\Http\Request;

class CalenderContrller extends Controller
{
    public function index ()  {
        $coupon = Coupon::all();
        $promotion = Promotion::all();
        return view('admin.calender.calender')->with(['promotion' => $promotion , 'coupon' => $coupon]  );
    }


}
