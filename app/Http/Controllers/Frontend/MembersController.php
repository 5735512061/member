<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Member;
use App\Model\RedeemReward;
use App\Model\GetCoupon;
use App\Model\Point;
use App\Model\RedeemPoint;
use App\PartnerShop;
use Auth;

class MembersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:member');
    }
    
    public function profile() {
        $member = Member::where('id',Auth::guard('member')->id())->orderBy('id','desc')->first();
        $partners = PartnerShop::groupBy('name')->orderBy('id','desc')->get(); 
        $member_id = Auth::guard('member')->user()->id;

         // หักคะแนนจากการแลกของรางวัล
         $redeem_rewards = RedeemReward::where('member_id',$member_id)
                                       ->join('reward_points', 'redeem_rewards.point_id', '=', 'reward_points.id')
                                       ->select('reward_points.*', 'redeem_rewards.*')->get();

        // คะแนนสะสม
        $points = Point::where('member_id',$member_id)->get();

        // หักคะแนนแลกสิทธิ์ร้านค้าพันธมิตร
        $redeem_points = RedeemPoint::where('member_id',$member_id)
                                    ->join('partner_shop_points', 'redeem_points.point_id', '=', 'partner_shop_points.id')
                                    ->where('redeem_points.updated_at','>','2022-02-01 00:00:00')
                                    ->select('partner_shop_points.*','redeem_points.*')->orderBy('partner_shop_points.id','desc')->get();

        return view('frontend/member/account/profile')->with('member',$member)
                                                      ->with('partners',$partners)
                                                      ->with('redeem_rewards',$redeem_rewards)
                                                      ->with('points',$points)
                                                      ->with('redeem_points',$redeem_points);
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
