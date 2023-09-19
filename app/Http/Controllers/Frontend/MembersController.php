<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Member;
use App\Model\RedeemReward;
use App\Model\GetCoupon;
use Auth;

class MembersController extends Controller
{
    public function profile() {
        $member = Member::where('id',Auth::guard('member')->id())->orderBy('id','desc')->first();
        return view('frontend/member/account/profile')->with('member',$member);
    }

    public function telChange(){
        $member = Auth::guard('member')->user();
        return view('frontend/member/account/tel-change')->with('member',$member);
    }

    public function telUpdate(Request $request) {
        $id = $request->get('id');
        $member = Member::findOrFail($id);
        $member->update($request->all());
    	return redirect()->action('Frontend\\MembersController@profile');
        
    }

    public function profileChange(){
        $member = Auth::guard('member')->user();
        return view('frontend/member/account/profile-change')->with('member',$member);
    }

    public function profileUpdate(Request $request) {
        $id = $request->get('id');
        
    	$member = Member::findOrFail($id);
        $member->update($request->all());

    	return redirect()->action('Frontend\\MembersController@profile');
    }

    public function coupon() {
        $member_id = Auth::guard('member')->user()->id;
        $coupons = GetCoupon::where('member_id',$member_id)->where('status','ยังไม่ใช้งาน')->get();
        return view('frontend/member/coupon/coupon')->with('coupons',$coupons);
    }
}
