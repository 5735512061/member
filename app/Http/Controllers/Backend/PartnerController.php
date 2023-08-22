<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Member;
use App\Model\Campaign;

class PartnerController extends Controller
{
    public function dashboard() {
        $search = 'No Search';
        return view('backend/partner/dashboard')->with('search',$search);
    }

    public function searchMember(Request $request) {
        $search = $request->get('search');
        $members = Member::where('tel',$search)->get();
        $count = count($members);
            if($count == 0) {
                $search = '0';
            }
        return view('backend/partner/dashboard')->with('members',$members)
                                                ->with('search',$search);
    }

    public function coupon() {
        $search = 'No Search';
        return view('backend/partner/coupon/coupon')->with('search',$search);
    }

    public function searchCoupon(Request $request) {
        $search = $request->get('code');
        $coupons = Campaign::where('code',$request->get('code'))->get();
        $count = count($coupons);
            if($count == 0) {
                $search = '0';
            }
        return view('backend/partner/coupon/coupon')->with('coupons',$coupons)
                                                    ->with('search',$search);
    }
}
