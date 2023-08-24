<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Reward;
use App\Model\Campaign;
use App\Model\Article;
use App\Model\PartnerShopPromotion;

class SystemController extends Controller
{
    public function index() {
        $rewards = Reward::where('status','กำลังใช้งาน')->paginate('6');
        $articles = Article::where('status','เปิด')->paginate('6');
        $partners = PartnerShopPromotion::where('status','เปิด')->paginate('6');
        return view('frontend/index')->with('rewards',$rewards)
                                     ->with('articles',$articles)
                                     ->with('partners',$partners);
    }

    public function condition() {
        return view('frontend/system/condition');
    }

    public function article() {
        $articles = Article::where('status','เปิด')->get();
        return view('frontend/system/article/article')->with('articles',$articles);
    }

    public function articleFood() {
        $articles = Article::where('type','อาหาร')->where('status','เปิด')->get();
        return view('frontend/system/article/article-food')->with('articles',$articles);
    }

    public function articleLifeStyle() {
        $articles = Article::where('type','ไลฟ์สไตล์')->where('status','เปิด')->get();
        return view('frontend/system/article/article-lifestyle')->with('articles',$articles);
    }

    public function articleBeauty() {
        $articles = Article::where('type','บิวตี้')->where('status','เปิด')->get();
        return view('frontend/system/article/article-beauty')->with('articles',$articles);
    }

    public function articleNews() {
        $articles = Article::where('type','ข่าว')->where('status','เปิด')->get();
        return view('frontend/system/article/article-news')->with('articles',$articles);
    }

    public function articleHoroscope() {
        $articles = Article::where('type','ดูดวง')->where('status','เปิด')->get();
        return view('frontend/system/article/article-horoscope')->with('articles',$articles);
    }

    public function articleGeneral() {
        $articles = Article::where('type','ทั่วไป')->where('status','เปิด')->get();
        return view('frontend/system/article/article-general')->with('articles',$articles);
    }

    public function articleDetail($id) {
        $article = Article::findOrFail($id);
        return view('frontend/system/article/article-detail')->with('article',$article);
    }

    public function privilege() {
        $coupons = Campaign::where('status','กำลังจัดแคมเปญ')->get();
        return view('frontend/system/privilege')->with('coupons',$coupons);
    }

    public function privilegeDetail($id) {
        $coupon = Campaign::findOrFail($id);
        return view('frontend/system/privilege-detail')->with('coupon',$coupon);
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
        return view('frontend/system/alliance/index');
    }

    public function allianceFoodAndDrink() {
        $partners = PartnerShopPromotion::where('status','เปิด')->get();
        return view('frontend/system/alliance/foodanddrink')->with('partners',$partners);
    }

    public function allianceLifeStyle() {
        $partners = PartnerShopPromotion::where('status','เปิด')->get();
        return view('frontend/system/alliance/lifestyle')->with('partners',$partners);
    }

    public function allianceTravel() {
        $partners = PartnerShopPromotion::where('status','เปิด')->get();
        return view('frontend/system/alliance/travel')->with('partners',$partners);
    }

    public function allianceCarService() {
        $partners = PartnerShopPromotion::where('status','เปิด')->get();
        return view('frontend/system/alliance/carservice')->with('partners',$partners);
    }

    public function allianceDetail($id) {
        $promotion = PartnerShopPromotion::findOrFail($id);
        return view('frontend/system/alliance/alliance-detail')->with('promotion',$promotion);
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
