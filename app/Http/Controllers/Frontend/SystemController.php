<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Reward;

class SystemController extends Controller
{
    public function index() {
        $rewards = Reward::where('status','กำลังใช้งาน')->get();
        return view('frontend/index')->with('rewards',$rewards);
    }

    public function condition() {
        return view('frontend/system/condition');
    }

    public function newsActivity() {
        return view('frontend/system/news-activity');
    }

    public function privilege() {
        return view('frontend/system/privilege');
    }

    public function reward() {
        $rewards = Reward::where('status','กำลังใช้งาน')->get();
        return view('frontend/system/reward')->with('rewards',$rewards);
    }

    public function rewardDetail($id) {
        $reward = Reward::findOrFail($id);
        return view('frontend/system/reward-detail')->with('reward',$reward);
    }


    public function alliance() {
        return view('frontend/system/alliance');
    }

    public function contactUs() {
        return view('frontend/system/contact-us');
    }

    public function aboutUs() {
        return view('frontend/system/about-us');
    }

    public function helpCenter() {
        return view('frontend/system/help-center');
    }
}
