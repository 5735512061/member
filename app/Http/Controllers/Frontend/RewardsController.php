<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\model\Reward;
use App\model\RedeemReward;
use App\model\RedeemPoint;
use App\model\Point;
use App\Member;
use Auth;
use Carbon\Carbon;

class RewardsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:member');
    }
    
    public function rewardRedem($id) {
        $reward = Reward::findOrFail($id);
        
        $member_id = Auth::guard('member')->user()->id;
        $member = Member::findOrFail($member_id);

        // หักคะแนนจากการแลกของรางวัล
        $redeem_rewards = RedeemReward::where('member_id',$member_id)
                                      ->join('reward_points', 'redeem_rewards.point_id', '=', 'reward_points.id')
                                      ->select('reward_points.*', 'redeem_rewards.*')->get();

        // คะแนนสะสม
        $points = Point::where('member_id',$member_id)->get();

        $dateNow = Carbon::now()->format('d/m/Y');

        // หักคะแนนแลกสิทธิ์ร้านค้าพันธมิตร
        $redeem_points = RedeemPoint::where('member_id',$member_id)
                                     ->join('partner_shop_points', 'redeem_points.point_id', '=', 'partner_shop_points.id')
                                     ->where('redeem_points.updated_at','>','2022-02-01 00:00:00')
                                     ->select('partner_shop_points.*','redeem_points.*')->orderBy('partner_shop_points.id','desc')->get();

        return view('frontend/member/reward/reward-redem')->with('member',$member)
                                                          ->with('dateNow',$dateNow)
                                                          ->with('points',$points)
                                                          ->with('reward',$reward)
                                                          ->with('redeem_rewards',$redeem_rewards)
                                                          ->with('redeem_points',$redeem_points);
    }
}
