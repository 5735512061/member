<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportExport;
use App\Exports\ReportMemberExport;

use App\AccountStore;
use App\AccountStaff;
use App\Member;
use App\Model\Point;
use App\Model\Tier;
use App\Model\Random;
use App\Model\Reward;
use App\Model\RewardPoint;
use App\Model\Campaign;
use App\Model\RedeemPoint;
use App\Model\RedeemReward;
use App\Model\PartnerShopPromotion;
use App\Model\Article;
use App\Model\SlideImageMain;
use App\Model\ArticleImage;
use App\PartnerShop;
use App\Model\GetCoupon;
use App\Model\PartnerShopPoint;

use Carbon\Carbon;
use Validator;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function dashboard(Request $request) {
        $NUM_PAGE = 20;
        $members = Member::sortable()->paginate($NUM_PAGE);

        $member_tires = Member::get();
        $groupMembers = array();

        foreach($member_tires as $member_tire => $value) {
            $sumprice = (int)Point::where('member_id',$value->id)->sum('price');
            array_push($groupMembers, $sumprice);    
        }

        $silver = 0;
        $gold = 0;
        $platinum = 0;
        $diamond = 0;

        for($i = 0; $i < count($groupMembers); $i++) {
            if($groupMembers[$i] == 0 || $groupMembers[$i] < 100001) {
                // SILVER
                $silver++;    
            }
            elseif($groupMembers[$i] == 100001 || $groupMembers[$i] < 500001) {
                // GOLD
                $gold++;
            }
            elseif($groupMembers[$i] == 500001 || $groupMembers[$i] < 1000001) {
                // PLATINUM
                $platinum++;
            }
            elseif($groupMembers[$i] > 1000001) {
                // DIAMOND
                $diamond++;
            }
            
        }
        $data_tier = "";
        $data_tier .= "['SILVER', $silver],['GOLD', $gold],['PLATINUM', $platinum],['DIAMOND', $diamond]";

        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/dashboard')->with('NUM_PAGE',$NUM_PAGE)
                                              ->with('page',$page)
                                              ->with('members',$members)
                                              ->with('silver',$silver)
                                              ->with('gold',$gold)
                                              ->with('platinum',$platinum)
                                              ->with('diamond',$diamond)
                                              ->with('data_tier',$data_tier);
    }

    public function accountStore(Request $request) {
        $NUM_PAGE = 15;
        $account_stores = AccountStore::selectRaw('*, count(*) as countBranch')->groupBy('store_name')->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/account-store/dashboard')->with('NUM_PAGE',$NUM_PAGE)
                                                            ->with('page',$page)
                                                            ->with('account_stores',$account_stores);
    }

    public function accountStoreName(Request $request, $store_name) {
        $NUM_PAGE = 15;
        $account_stores = AccountStore::where('store_name',$store_name)->get();
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/account-store/store-name')->with('NUM_PAGE',$NUM_PAGE)
                                                             ->with('page',$page)
                                                             ->with('account_stores',$account_stores);
    }

    public function createAccountStore() {
        return view('backend/admin/account-store/create-account');
    }

    public function createAccountStorePost(Request $request) {
        if($request->hasFile('image')) { 
            $image = $request->file('image');
            $filename = md5(($image->getClientOriginalName(). time()) . time()) . "_o." . $image->getClientOriginalExtension();
            $image->move('images/store-logo/', $filename);
            $path = 'images/'.$filename;
        }

        foreach ($request->inputs as $key => $value) {
            $account_store = new AccountStore;
            $account_store->store_name = $request->get('store_name');
            $account_store->branch = $value['branch'];
            $account_store->tel = $value['tel'];
            $account_store->username = $value['username'];
            $account_store->password_name = $value['password_name'];
            $account_store['password'] = bcrypt($value['password_name']);
            $account_store->image = $filename;
            $account_store->save();
        }
                
        return back();
    }

    public function editAccountStore($id) {
        $account_store = AccountStore::findOrFail($id);
        return view('backend/admin/account-store/edit-account')->with('account_store',$account_store);
    }

    public function updateAccountStore(Request $request) {
        $id = $request->get('id');
        $account_store = AccountStore::findOrFail($id);
        $account_store->update($request->all());

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = md5(($image->getClientOriginalName(). time()) . time()) . "_o." . $image->getClientOriginalExtension();
            $image->move('images/store-logo/', $filename);
            $path = 'images/'.$filename;

            $account_stores = AccountStore::get();
            foreach($account_stores as $account_store => $value) {
                if($value->store_name == $request->get('store_name')) {
                    $account_store = AccountStore::findOrFail($value->id);
                    $account_store->image = $filename; 
                    $account_store->save();
                }
            }
            
        }
        return redirect()->action('Backend\AdminController@accountStore'); 
    }


    public function createAccountStaff($store_name, $branch) {
        return view('backend/admin/account-staff/create-account')->with('store_name',$store_name)
                                                                 ->with('branch',$branch);
    }

    public function createAccountStaffPost(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_createAccountStaff(), $this->messages_createAccountStaff());
        if($validator->passes()) {
            
            $account_staff = $request->all();
            $account_staff['password'] = bcrypt($account_staff['password_name']);
            $account_staff = AccountStaff::create($account_staff);

            $request->session()->flash('alert-success', 'สร้างบัญชีพนักงานสำเร็จ');
            return redirect()->action('Backend\AdminController@accountStore');
        }else{
            $request->session()->flash('alert-danger', 'สร้างบัญชีพนักงานไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();   
        }
    }

    public function accountStaff(Request $request, $store_name, $branch) {
        $NUM_PAGE = 15;
        $store_id = AccountStore::where('store_name',$store_name)->where('branch',$branch)->value('id');
        $account_staffs = AccountStaff::where('store_id',$store_id)->get();
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/account-staff/dashboard')->with('NUM_PAGE',$NUM_PAGE)
                                                            ->with('page',$page)
                                                            ->with('store_name',$store_name)
                                                            ->with('branch',$branch)
                                                            ->with('account_staffs',$account_staffs);
    }

    public function editAccountStaff(Request $request,$id) {
        $staff = AccountStaff::findOrFail($id);
        return view('backend/admin/account-staff/edit-account')->with('staff',$staff);
    }

    public function editAccountStaffPost(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_editAccountStaff(), $this->messages_editAccountStaff());
        if($validator->passes()) {
            $id = $request->get('id');
            $staff = AccountStaff::findOrFail($id);
            $staff->update($request->all());

            $request->session()->flash('alert-success', 'แก้ไขบัญชีพนักงานสำเร็จ');
            return redirect()->action('Backend\AdminController@accountStore');
        } else {
            $request->session()->flash('alert-danger', 'แก้ไขบัญชีพนักงานไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function addpoint(Request $request) {
        $search = 'No Search';
        return view('backend/admin/member/addpoint')->with('search',$search);
    }

    public function addPointPost(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_addPoint(), $this->messages_addPoint());
        if($validator->passes()) {
            $point = $request->all();
            $point = Point::create($point);

            $request->session()->flash('alert-success', 'เพิ่มคะแนนสะสมสำเร็จ');
            return back();
        } else{
            $request->session()->flash('alert-danger', 'เพิ่มคะแนนสะสมไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();   
        }
    }

    public function editPoint(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_editPoint(), $this->messages_editPoint());
        if($validator->passes()) {
            $id = $request->get('id');
            $point = Point::findOrFail($id);
            $point->update($request->all());

            $request->session()->flash('alert-success', 'แก้ไขคะแนนสะสมสำเร็จ');
            return back();
        } else {
            $request->session()->flash('alert-danger', 'แก้ไขคะแนนสะสมไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function searchMember(Request $request) {
        $search = $request->get('search');
        $members = Member::where('tel',$search)->get();
        $count = count($members);
            if($count == 0) {
                $search = '0';
            }
        return view('backend/admin/member/addpoint')->with('members',$members)
                                                    ->with('search',$search);
    }

    // public function memberList(Request $request) {
    //     $NUM_PAGE = 50;
    //     // $members = Member::paginate($NUM_PAGE);
    //     $members = Member::get();
    //     $page = $request->input('page');
    //     $page = ($page != null)?$page:1;
    //     return view('backend/admin/member/member-list')->with('page',$page)
    //                                                    ->with('NUM_PAGE',$NUM_PAGE)
    //                                                    ->with('members',$members);
    // }

    public function memberList(Request $request) {
        $NUM_PAGE = 50;
        $members = Member::paginate(50);
        if ($request->ajax()) {
            $view = view('backend/admin/member/data', compact('members'))->render();
            return response()->json(['html' => $view]);
        }
        // $page = $request->input('page');
        // $page = ($page != null)?$page:1;
        return view('backend/admin/member/member-list', compact('members'))->with('NUM_PAGE',$NUM_PAGE);
    }

    public function memberListOn(Request $request) {
        $NUM_PAGE = 50;
        $members = Member::where('status',"ONLINE")->paginate(50);
        if ($request->ajax()) {
            $view = view('backend/admin/member/data', compact('members'))->render();
            return response()->json(['html' => $view]);
        }
        // $page = $request->input('page');
        // $page = ($page != null)?$page:1;
        return view('backend/admin/member/member-list-on', compact('members'))->with('NUM_PAGE',$NUM_PAGE);
    }

    public function memberListOff(Request $request) {
        $NUM_PAGE = 50;
        $members = Member::where('status',"OFFLINE")->paginate(50);
        if ($request->ajax()) {
            $view = view('backend/admin/member/data', compact('members'))->render();
            return response()->json(['html' => $view]);
        }
        // $page = $request->input('page');
        // $page = ($page != null)?$page:1;
        return view('backend/admin/member/member-list-off', compact('members'))->with('NUM_PAGE',$NUM_PAGE);
    }

    public function searchMemberList(Request $request) {
        $NUM_PAGE = 20;
        $search = $request->get('search');
        $members = Member::where('tel',$search)->paginate($NUM_PAGE);
        $count = count($members);
            if($count == 0) {
                $search = '0';
            }
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/member/member-list')->with('NUM_PAGE',$NUM_PAGE)
                                                       ->with('page',$page)
                                                       ->with('members',$members)
                                                       ->with('search',$search);
    }

    public function searchMemberTier(Request $request) {
        $NUM_PAGE = 20;

        $search = $request->get('tier');
        $sumprice = Point::groupBy('member_id')->sum('price');

        if($search == "SILVER") {
            if ($sumprice == 0 || $sumprice < 100001) {
                $members = Member::join('points', 'members.id', '=', 'points.member_id')
                       ->select('members.*', 'points.price')
                       ->get();
            } else {
                $members = 0;
            }
        }

        if($search == "GOLD") {
            if($sumprice == 100001 || $sumprice < 500001) {
                $members = Member::join('points', 'members.id', '=', 'points.member_id')
                       ->select('members.*', 'points.price')
                       ->get();
            } else {
                $members = 0;
            }
        }

        if($search == "PLATINAM") {
            if($sumprice == 500001 || $sumprice < 1000001) {dd($sumprice);
                $members = Member::join('points', 'members.id', '=', 'points.member_id')
                       ->select('members.*', 'points.price')
                       ->get();
            } else {
                $members = 0;
            }
        }
        
        if($search == "DIAMOND") {
            if($sumprice > 1000001) {
                $members = Member::join('points', 'members.id', '=', 'points.member_id')
                       ->select('members.*', 'points.price')
                       ->get();
            } else {
                $members = 0;
            }
        }
        
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/member/member-list')->with('NUM_PAGE',$NUM_PAGE)
                                                       ->with('page',$page)
                                                       ->with('members',$members)
                                                       ->with('search',$search);
    }

    public function memberProfile(Request $request, $id) {
        $NUM_PAGE = 20;
        $member = Member::findOrFail($id);
        $points = Point::where('member_id',$id)->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/member/member-profile')->with('NUM_PAGE',$NUM_PAGE)
                                                          ->with('page',$page)
                                                          ->with('member',$member)
                                                          ->with('points',$points);
    }

    public function campaign(Request $request) {
        $NUM_PAGE = 20;
        $campaigns = Campaign::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/campaign/campaign-dashboard')->with('NUM_PAGE',$NUM_PAGE)
                                                                ->with('page',$page)
                                                                ->with('campaigns',$campaigns);
    }

    public function campaignOn(Request $request) {
        $NUM_PAGE = 20;
        $campaigns = Campaign::where('status','กำลังจัดแคมเปญ')->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/campaign/campaign-dashboard-on')->with('NUM_PAGE',$NUM_PAGE)
                                                                   ->with('page',$page)
                                                                   ->with('campaigns',$campaigns);
    }

    public function campaignNotActive(Request $request) {
        $NUM_PAGE = 20;
        $campaigns = Campaign::where('status','ยังไม่เริ่มแคมเปญ')->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/campaign/campaign-dashboard-notActive')->with('NUM_PAGE',$NUM_PAGE)
                                                                          ->with('page',$page)
                                                                          ->with('campaigns',$campaigns);
    }

    public function campaignPause(Request $request) {
        $NUM_PAGE = 20;
        $campaigns = Campaign::where('status','แคมเปญถูกพัก')->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/campaign/campaign-dashboard-pause')->with('NUM_PAGE',$NUM_PAGE)
                                                                      ->with('page',$page)
                                                                      ->with('campaigns',$campaigns);
    }

    public function campaignOff(Request $request) {
        $NUM_PAGE = 20;
        $campaigns = Campaign::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/campaign/campaign-dashboard-off')->with('NUM_PAGE',$NUM_PAGE)
                                                                    ->with('page',$page)
                                                                    ->with('campaigns',$campaigns);
    }

    public function createCampaign() {
        return view('backend/admin/campaign/create-campaign');
    }

    public function createCampaignPost(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_createCampaign(), $this->messages_createCampaign());
        if($validator->passes()) {
            $campaign = $request->all();
            $campaign = Campaign::create($campaign);
            if($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = md5(($image->getClientOriginalName(). time()) . time()) . "_o." . $image->getClientOriginalExtension();
                $image->move('images/campaign/', $filename);
                $path = 'images/'.$filename;
                $campaign->image = $filename;
                $campaign->save();
            }

            $request->session()->flash('alert-success', 'สร้างแคมเปญสำเร็จ');
            return redirect()->action('Backend\AdminController@campaign');
        }else{
            $request->session()->flash('alert-danger', 'สร้างแคมเปญไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง !!');
            return back()->withErrors($validator)->withInput();   
        }
    }

    public function campaignEdit($id) {
        $campaign = Campaign::findOrFail($id);
        return view('/backend/admin/campaign/campaign-edit')->with('campaign',$campaign);
    }

    public function updateCampaign(Request $request) {
        $id = $request->get('id');
        $campaign = Campaign::findOrFail($id);
        $campaign->update($request->all());

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = md5(($image->getClientOriginalName(). time()) . time()) . "_o." . $image->getClientOriginalExtension();
            $image->move('images/campaign/', $filename);
            $path = 'images/'.$filename;
            $campaign = Campaign::findOrFail($id);
            $campaign->image = $filename; 
            $campaign->save();
        }
        return redirect()->action('Backend\AdminController@campaign'); 
    }

    public function campaignDelete(Request $request, $id) {
        $coupon = GetCoupon::where('coupon_id',$id)->get();
        if(count($coupon) != 0) {
            $request->session()->flash('alert-danger', 'ลบข้อมูลคูปองไม่สำเร็จ เนื่องจากข้อมูลมีการใช้งาน');
            return redirect()->action('Backend\AdminController@campaign');
        } else {
            $campaign = Campaign::destroy($id);
            $request->session()->flash('alert-success', 'ลบข้อมูลคูปองสำเร็จ');
            return redirect()->action('Backend\AdminController@campaign');
        }
    }

    public function reward(Request $request) {
        $NUM_PAGE = 20;
        $rewards = Reward::orderByRaw('FIELD(status,"กำลังใช้งาน","ปิดการใช้งาน","พักการใช้งาน","ยังไม่ใช้งาน")')->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/reward/reward-dashboard')->with('NUM_PAGE',$NUM_PAGE)
                                                            ->with('page',$page)
                                                            ->with('rewards',$rewards);
    }

    public function rewardOn(Request $request) {
        $NUM_PAGE = 20;
        $rewards = Reward::where('status','กำลังใช้งาน')->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/reward/reward-dashboard-on')->with('NUM_PAGE',$NUM_PAGE)
                                                               ->with('page',$page)
                                                               ->with('rewards',$rewards);
    }

    public function rewardNotActive(Request $request) {
        $NUM_PAGE = 20;
        $rewards = Reward::where('status','ยังไม่ใช้งาน')->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/reward/reward-dashboard-notActive')->with('NUM_PAGE',$NUM_PAGE)
                                                                      ->with('page',$page)
                                                                      ->with('rewards',$rewards);
    }

    public function rewardPause(Request $request) {
        $NUM_PAGE = 20;
        $rewards = Reward::where('status','พักการใช้งาน')->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/reward/reward-dashboard-pause')->with('NUM_PAGE',$NUM_PAGE)
                                                                  ->with('page',$page)
                                                                  ->with('rewards',$rewards);
    }

    public function rewardOff(Request $request) {
        $NUM_PAGE = 20;
        $rewards = Reward::where('status','ปิดการใช้งาน')->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/reward/reward-dashboard-off')->with('NUM_PAGE',$NUM_PAGE)
                                                                ->with('page',$page)
                                                                ->with('rewards',$rewards);
    }

    public function createReward() {
        return view('backend/admin/reward/create-reward');
    }

    public function createRewardPost(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_createReward(), $this->messages_createReward());
        if($validator->passes()) {
            $reward = new Reward;
            $reward->name = $request->get('name');
            $reward->reward_type = $request->get('reward_type');
            $reward->detail = $request->get('detail');
            $reward->status = $request->get('status');
            if($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = md5(($image->getClientOriginalName(). time()) . time()) . "_o." . $image->getClientOriginalExtension();
                $image->move('images/reward/', $filename);
                $path = 'images/'.$filename;
                $reward->image = $filename;
                $reward->save();
            }
            $reward->save();

            $reward_id = Reward::orderBy('id','desc')->value('id');

            $reward_point = new RewardPoint;
            $reward_point->reward_id = $reward_id;
            $reward_point->point = $request->get('point');
            $reward_point->date = Carbon::now()->format('d/m/Y');
            $reward_point->save();

            $request->session()->flash('alert-success', 'เพิ่มของรางวัลสำเร็จ');
            return redirect()->action('Backend\AdminController@reward');
        } else{
            $request->session()->flash('alert-danger', 'เพิ่มของรางวัลไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง !!');
            return back()->withErrors($validator)->withInput();   
        }
    }

    public function rewardDelete(Request $request, $id) {
        $point = RedeemReward::where('reward_id',$id)->get();
        if(count($point) != 0) {
            $request->session()->flash('alert-danger', 'ลบข้อมูลของรางวัลไม่สำเร็จ เนื่องจากข้อมูลมีการใช้งาน');
            return redirect()->action('Backend\AdminController@reward');
        } else {
            $reward_point = RewardPoint::where('reward_id',$id)->delete();
            $reward = Reward::destroy($id);
            $request->session()->flash('alert-success', 'ลบข้อมูลของรางวัลสำเร็จ');
            return redirect()->action('Backend\AdminController@reward');
        }
    }

    public function rewardEdit($id) {
        $reward = Reward::findOrFail($id);
        return view('/backend/admin/reward/reward-edit')->with('reward',$reward);
    }

    public function updateReward(Request $request) {
        $id = $request->get('id');
        $point_id = RewardPoint::where('reward_id',$id)->value('id');

        $reward = Reward::findOrFail($id);
        $reward->update($request->all());
        $reward_point = RewardPoint::findOrFail($point_id);
        $reward_point->update($request->all());

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = md5(($image->getClientOriginalName(). time()) . time()) . "_o." . $image->getClientOriginalExtension();
            $image->move('images/reward/', $filename);
            $path = 'images/'.$filename;
            $reward = Reward::findOrFail($id);
            $reward->image = $filename; 
            $reward->save();
        }
        return redirect()->action('Backend\AdminController@reward'); 
    }

    public function redeemReward(Request $request) {
        $NUM_PAGE = 20;
        $redeem_rewards = RedeemReward::orderByRaw('FIELD(status,"รอดำเนินการ","แลกรางวัลสำเร็จ")')->orderBy('id','desc')->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/member/redeem-reward')->with('NUM_PAGE',$NUM_PAGE)
                                                         ->with('page',$page)
                                                         ->with('redeem_rewards',$redeem_rewards);
    }

    public function confirmRedeemReward(Request $request) {
        $redeem_reward = RedeemReward::findOrFail($request->get('id'));
        $redeem_reward->status = $request->get('status');
        $redeem_reward->save();
        return redirect()->action('Backend\AdminController@redeemReward'); 
    }

    public function addTierPost(Request $request) {
        $tier = $request->all();
        $tier = Tier::create($tier);
        return back();
    }

    public function editProfile(Request $request, $id) {
        $member = Member::findOrFail($id);
        return view('backend/admin/member/edit-profile')->with('member',$member);
    }

    public function editProfilePost(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_editProfile(), $this->messages_editProfile());
        if($validator->passes()) {
            $id = $request->get('id');
            $member = Member::findOrFail($id);
            $member->update($request->all());

            $request->session()->flash('alert-success', 'แก้ไขโปรไฟล์สมาชิกสำเร็จ');
            return redirect()->action('Backend\AdminController@memberProfile',['id' => $id]);
        }
        else{
            $request->session()->flash('alert-danger', 'แก้ไขโปรไฟล์สมาชิกไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return redirect()->action('Backend\AdminController@editProfile',['id' => $request->get('id')])->withErrors($validator)->withInput();   
        }
    }

    public function partner(Request $request) {
        $NUM_PAGE = 100;
        $partners = PartnerShop::orderByRaw('FIELD(status,"เปิด","ปิด")')->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/partner/index')->with('NUM_PAGE',$NUM_PAGE)
                                                  ->with('page',$page)
                                                  ->with('partners',$partners);
    }

    public function partnerOff(Request $request) {
        $NUM_PAGE = 100;
        $partners = PartnerShop::where('status','ปิด')->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/partner/partner-off')->with('NUM_PAGE',$NUM_PAGE)
                                                        ->with('page',$page)
                                                        ->with('partners',$partners);
    }

    public function createPartner() {
        return view('backend/admin/partner/create-partner');
    }

    public function createPartnerPost(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_createPartner(), $this->messages_createPartner());
        if($validator->passes()) {

            $partner = $request->all();
            $partner['password'] = bcrypt($partner['tel']);
            $partner = PartnerShop::create($partner);

            if($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = md5(($image->getClientOriginalName(). time()) . time()) . "_o." . $image->getClientOriginalExtension();
                $image->move('images/partner_shop/', $filename);
                $path = 'images/'.$filename;
                $partner->image = $filename;
                $partner->save();
            }

            $request->session()->flash('alert-success', 'เพิ่มเครือข่ายพันธมิตรสำเร็จ');
            return redirect()->action('Backend\AdminController@partner');
        }else{
            $request->session()->flash('alert-danger', 'เพิ่มเครือข่ายพันธมิตรไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง !!');
            return back()->withErrors($validator)->withInput();   
        }
    }

    public function partnerEdit($id) {
        $partner = PartnerShop::findOrFail($id);
        return view('/backend/admin/partner/partner-edit')->with('partner',$partner);
    }

    public function updatePartner(Request $request) {
        $id = $request->get('id');

        $partner = PartnerShop::findOrFail($id);
        $partner->update($request->all());

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = md5(($image->getClientOriginalName(). time()) . time()) . "_o." . $image->getClientOriginalExtension();
            $image->move('images/partner_shop/', $filename);
            $path = 'images/'.$filename;
            $partner = PartnerShop::findOrFail($id);
            $partner->image = $filename; 
            $partner->save();
        }
        
        return redirect()->action('Backend\AdminController@partner'); 
    }

    public function partnerAddPromotion($id) {
        return view('/backend/admin/partner/partner-add-promotion')->with('id',$id);
    }

    public function partnerAddPromotionPost(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_partnerAddPromotion(), $this->messages_partnerAddPromotion());
        if($validator->passes()) {

            $promotion = $request->all();
            $promotion = PartnerShopPromotion::create($promotion);

            if($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = md5(($image->getClientOriginalName(). time()) . time()) . "_o." . $image->getClientOriginalExtension();
                $image->move('images/partner/', $filename);
                $path = 'images/'.$filename;
                $promotion->image = $filename;
                $promotion->save();
            }

            // เก็บคะแนนในตาราง partner_shop_points
            $id = PartnerShopPromotion::orderBy('id','desc')->value('id');

            $point = new PartnerShopPoint;
            $point->partner_id = $id;
            $point->point = $request->get('point');
            $point->date = Carbon::now()->format('d/m/Y');
            $point->save();

            $request->session()->flash('alert-success', 'เพิ่มโปรโมชั่นสำเร็จ');
            return redirect()->action('Backend\AdminController@partner');
        }else{
            $request->session()->flash('alert-danger', 'เพิ่มโปรโมชั่นสำเร็จไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง !!');
            return back()->withErrors($validator)->withInput();   
        }
    }

    public function partnerPromotion(Request $request, $id) {
        $NUM_PAGE = 50;
        $promotions = PartnerShopPromotion::where('partner_id',$id)->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/partner/partner-promotion')->with('NUM_PAGE',$NUM_PAGE)
                                                              ->with('page',$page)
                                                              ->with('promotions',$promotions)
                                                              ->with('id',$id);
    }

    public function deletePromotion(Request $request, $id) {
        $point = PartnerShopPoint::where('partner_id',$id)->delete();
        $promotion = PartnerShopPromotion::destroy($id);
        $request->session()->flash('alert-success', 'ลบข้อมูลโปรโมชั่นสำเร็จ');
        return redirect()->action('Backend\AdminController@partner');
    }

    public function promotionEdit($id) {
        $promotion = PartnerShopPromotion::findOrFail($id);
        return view('/backend/admin/partner/promotion-edit')->with('promotion',$promotion);
    }

    public function updatePromotion(Request $request) {
        $id = $request->get('id');

        $promotion = PartnerShopPromotion::findOrFail($id);
        $promotion->update($request->all());

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = md5(($image->getClientOriginalName(). time()) . time()) . "_o." . $image->getClientOriginalExtension();
            $image->move('images/partner/', $filename);
            $path = 'images/'.$filename;
            $promotion = PartnerShopPromotion::findOrFail($id);
            $promotion->image = $filename; 
            $promotion->save();
        }


        return redirect()->action('Backend\AdminController@partner'); 
    }

    public function reportPartner(Request $request) {
        $NUM_PAGE = 20;
        $redeem_points = RedeemPoint::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('/backend/admin/partner/report-partner')->with('NUM_PAGE',$NUM_PAGE)
                                                            ->with('page',$page)
                                                            ->with('redeem_points',$redeem_points);
    }

    public function exportReportPartner(){
        return Excel::download(new ReportExport, 'รายงานการใช้พันธมิตร.xlsx');
    }

    public function article(Request $request) {
        $NUM_PAGE = 20;
        $articles = Article::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/article/index')->with('NUM_PAGE',$NUM_PAGE)
                                                  ->with('page',$page)
                                                  ->with('articles',$articles);
    }

    public function createArticle() {
        return view('backend/admin/article/create-article');
    }

    public function createArticlePost(Request $request) {
        $article = $request->all();
        $article = Article::create($article);
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = md5(($image->getClientOriginalName(). time()) . time()) . "_o." . $image->getClientOriginalExtension();
            $image->move('images/article/', $filename);
            $path = 'images/'.$filename;
            $article->image = $filename;
            $article->save();
        }
        return redirect()->action('Backend\AdminController@article');
    }

    public function deleteArticle(Request $request, $id) {
        $article = Article::destroy($id);
        $request->session()->flash('alert-success', 'ลบข้อมูลบทความสำเร็จ');
        return redirect()->action('Backend\AdminController@article');
    }

    public function articleEdit($id) {
        $article = Article::findOrFail($id);
        return view('/backend/admin/article/article-edit')->with('article',$article);
    }

    public function updateArticle(Request $request) {
        $id = $request->get('id');

        $article = Article::findOrFail($id);
        $article->update($request->all());
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = md5(($image->getClientOriginalName(). time()) . time()) . "_o." . $image->getClientOriginalExtension();
            $image->move('images/article/', $filename);
            $path = 'images/'.$filename;
            $article = Article::findOrFail($id);
            $article->image = $filename; 
            $article->save();
        }

        return redirect()->action('Backend\AdminController@article'); 
    }

    public function media() {
        return view('backend/admin/media/index');
    }

    public function uploadSlideImage(Request $request) {
        $NUM_PAGE = 20;
        $images = SlideImageMain::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/media/slide-image/upload-slide-image')->with('NUM_PAGE',$NUM_PAGE)
                                                                         ->with('page',$page)
                                                                         ->with('images',$images);
    }

    public function uploadSlideImagePost(Request $request) {
        $slide_image = $request->all();
        $slide_image = SlideImageMain::create($slide_image);
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = md5(($image->getClientOriginalName(). time()) . time()) . "_o." . $image->getClientOriginalExtension();
            $image->move('images/slide_main/', $filename);
            $path = 'images/'.$filename;
            $slide_image->image = $filename;
            $slide_image->save();
        }
        return redirect()->action('Backend\AdminController@uploadSlideImage');
    }

    public function slideImageDelete(Request $request, $id) {
        $slide_image = SlideImageMain::destroy($id);
        $request->session()->flash('alert-success', 'ลบรูปภาพสำเร็จ');
        return redirect()->action('Backend\AdminController@uploadSlideImage');
    }

    public function slideImageEdit($id) {
        $slide_image = SlideImageMain::findOrFail($id);
        return view('backend/admin/media/slide-image/edit-slide-image')->with('slide_image',$slide_image);
    }

    public function updateSlideImage(Request $request) {
        $id = $request->get('id');

        $slide_image = SlideImageMain::findOrFail($id);
        $slide_image->update($request->all());
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = md5(($image->getClientOriginalName(). time()) . time()) . "_o." . $image->getClientOriginalExtension();
            $image->move('images/slide_main/', $filename);
            $path = 'images/'.$filename;
            $slide_image = SlideImageMain::findOrFail($id);
            $slide_image->image = $filename; 
            $slide_image->save();
        }

        return redirect()->action('Backend\AdminController@uploadSlideImage'); 
    }

    public function uploadArticleImage(Request $request) {
        $NUM_PAGE = 20;
        $images = ArticleImage::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/media/article-image/upload-article-image')->with('NUM_PAGE',$NUM_PAGE)
                                                                             ->with('page',$page)
                                                                             ->with('images',$images);
    }

    public function uploadArticleImagePost(Request $request) {
        $article_image = $request->all();
        $article_image = ArticleImage::create($article_image);
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = md5(($image->getClientOriginalName(). time()) . time()) . "_o." . $image->getClientOriginalExtension();
            $image->move('images/article_image/', $filename);
            $path = 'images/'.$filename;
            $article_image->image = $filename;
            $article_image->save();
        }
        return redirect()->action('Backend\AdminController@uploadArticleImage');
    }

    public function articleImageDelete(Request $request, $id) {
        $article_image = ArticleImage::destroy($id);
        $request->session()->flash('alert-success', 'ลบรูปภาพสำเร็จ');
        return redirect()->action('Backend\AdminController@uploadArticleImage');
    }

    public function articleImageEdit($id) {
        $article_image = ArticleImage::findOrFail($id);
        return view('backend/admin/media/article-image/edit-article-image')->with('article_image',$article_image);
    }

    public function updateArticleImage(Request $request) {
        $id = $request->get('id');

        $article_image = ArticleImage::findOrFail($id);
        $article_image->update($request->all());
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = md5(($image->getClientOriginalName(). time()) . time()) . "_o." . $image->getClientOriginalExtension();
            $image->move('images/article_image/', $filename);
            $path = 'images/'.$filename;
            $article_image = ArticleImage::findOrFail($id);
            $article_image->image = $filename; 
            $article_image->save();
        }

        return redirect()->action('Backend\AdminController@uploadArticleImage'); 
    }

    public function exportReportMember(){
        return Excel::download(new ReportMemberExport, 'ข้อมูลสมาชิกเดอะซีเคร็ท.xlsx');
    }

    public function rules_editProfile() {
        return [
            'name' => 'required',
            'surname' => 'required',
            'bday' => 'required',
            'tel' => 'required',
        ];
    }

    public function messages_editProfile() {
        return [
            'name.required' => 'กรุณากรอกชื่อ',
            'surname.required' => 'กรุณากรอกนามสกุล',
            'bday.required' => 'กรุณากรอกวันเดือนปีเกิด',
            'tel.required' => 'กรุณากรอกเบอร์โทรศัพท์',
        ];
    }
    
    public function rules_addPoint() {
        return [
            'bill_number' => 'required|unique:points',
            'price' => 'required',
        ];
    }

    public function messages_addPoint() {
        return [
            'bill_number.required' => 'กรุณากรอกหมายเลขบิล',
            'bill_number.unique' => 'หมายเลขบิลซ้ำ',
            'price.required' => 'กรุณากรอกจำนวนเงิน',
        ];
    }

    public function rules_editPoint() {
        return [
            'bill_number' => 'required',
            'price' => 'required',
        ];
    }

    public function messages_editPoint() {
        return [
            'bill_number.required' => 'กรุณากรอกหมายเลขบิล',
            'price.required' => 'กรุณากรอกจำนวนเงิน',
        ];
    }

    public function rules_createAccountStaff() {
        return [
            'name' => 'required',
            'username' => 'required|unique:account_staffs',
            'password_name' => 'required',
            'password_confirmation' => 'required',
        ];
    }

    public function messages_createAccountStaff() {
        return [
            'name.required' => 'กรุณากรอกชื่อ',
            'username.required' => 'กรุณากรอกชื่อเข้าใช้งาน',
            'username.unique' => 'ชื่อเข้าใช้งานมีผู้ใช้แล้ว',
            'password_name.required' => 'กรุณากรอกรหัสผ่าน',
            'password_confirmation.required' => 'กรุณายืนยันรหัสผ่าน',
        ];
    }

    public function rules_editAccountStaff() {
        return [
            'name' => 'required',
        ];
    }

    public function messages_editAccountStaff() {
        return [
            'name.required' => 'กรุณากรอกชื่อ',
        ];
    }

    public function rules_createReward() {
        return [
            'name' => 'required',
            'detail' => 'required',
            'image' => 'required',
            'point' => 'required',
        ];
    }

    public function messages_createReward() {
        return [
            'name.required' => 'กรุณากรอกชื่อของรางวัล',
            'detail.required' => 'กรุณากรอกเงื่อนไขในการแลกของรางวัล',
            'image.required' => 'กรุณาแนบไฟล์รูปภาพ',
            'point.required' => 'กรุณากรอกพอยท์ที่ใช้แลก',
        ];
    }

    public function rules_createCampaign() {
        return [
            'name' => 'required',
            'expire_date' => 'required',
            'detail' => 'required',
            'image' => 'required',
        ];
    }

    public function messages_createCampaign() {
        return [
            'name.required' => 'กรุณากรอกชื่อแคมเปญ',
            'expire_date.required' => 'กรุณากรอกวันที่สิ้นสุดแคมเปญ',
            'detail.required' => 'กรุณากรอกเงื่อนไขในการใช้สิทธิ์',
            'image.required' => 'กรุณาแนบไฟล์รูปภาพ',
        ];
    }

    public function rules_createPartner() {
        return [
            'name' => 'required',
            'tel' => 'required|unique:partner_shops',
        ];
    }

    public function messages_createPartner() {
        return [
            'name.required' => 'กรุณากรอกชื่อพันธมิตร',
            'tel.required' => 'กรุณากรอกเบอร์โทรศัพท์',
            'tel.unique' => 'เบอร์โทรศัพท์นี้มีผู้ใช้แล้ว',
        ];
    }

    public function rules_partnerAddPromotion() {
        return [
            'promotion' => 'required',
        ];
    }

    public function messages_partnerAddPromotion() {
        return [
            'promotion.required' => 'กรุณากรอกรายละเอียดโปรโมชั่น',
        ];
    }
}
