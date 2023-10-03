<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\PartnerShopPromotion;
use App\Model\RedeemPoint;
use App\Model\PartnerShopPoint;
use App\PartnerShop;

use Auth;
use Carbon\Carbon;

class PartnersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:member');
    }

    public function allianceRedem($id) {  
        $partner_promotion = PartnerShopPromotion::findOrFail($id);
        $member_id = Auth::guard('member')->user()->id;
        $partner_id = PartnerShop::where('id',$partner_promotion->partner_id)->value('id');
        $point_id = PartnerShopPoint::where('partner_id',$partner_promotion->id)->value('id');
        $date = Carbon::now()->format('d/m/Y');
        $code = str_random(8);
    
        $redeem_point = new RedeemPoint;
        $redeem_point->member_id = $member_id;
        $redeem_point->partner_id = $partner_id;
        $redeem_point->point_id = $point_id;
        $redeem_point->promotion_id = $id;
        $redeem_point->date = $date;
        $redeem_point->code = $code;
        $redeem_point->save(); 
        dd('test');

        // // หักคะแนนจากการแลกของรางวัล
        // $redeem_rewards = RedeemReward::where('member_id',$member_id)
        //                               ->join('reward_points', 'redeem_rewards.point_id', '=', 'reward_points.id')
        //                               ->select('reward_points.*', 'redeem_rewards.*')->get();

        // // คะแนนสะสม
        // $points = Point::where('member_id',$member_id)->get();

        // $dateNow = Carbon::now()->format('d/m/Y');

        // // หักคะแนนแลกสิทธิ์ร้านค้าพันธมิตร
        // $redeem_points = RedeemPoint::where('member_id',$member_id)
        //                              ->join('partner_shop_points', 'redeem_points.point_id', '=', 'partner_shop_points.id')
        //                              ->where('redeem_points.updated_at','>','2022-02-01 00:00:00')
        //                              ->select('partner_shop_points.*','redeem_points.*')->orderBy('partner_shop_points.id','desc')->get();

        // return view('frontend/member/reward/reward-redem')->with('member',$member)
        //                                                   ->with('dateNow',$dateNow)
        //                                                   ->with('points',$points)
        //                                                   ->with('reward',$reward)
        //                                                   ->with('redeem_rewards',$redeem_rewards)
        //                                                   ->with('redeem_points',$redeem_points);
    }
}
