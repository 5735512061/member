<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\AccountStaff;
use App\AccountStore;
use App\Member;
use App\Model\Point;
use App\Model\Campaign;
use App\Model\GetCoupon;

use Auth;
use Validator;

class AdminStoreController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin-store');
    }

    public function dashboard(Request $request) {
        $NUM_PAGE = 10;
        $members = Member::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/adminStore/dashboard')->with('NUM_PAGE',$NUM_PAGE)
                                                   ->with('page',$page)
                                                   ->with('members',$members);
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
        return view('backend/adminStore/dashboard')->with('NUM_PAGE',$NUM_PAGE)
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
        return view('backend/adminStore/member/member-profile')->with('NUM_PAGE',$NUM_PAGE)
                                                               ->with('page',$page)
                                                               ->with('member',$member)
                                                               ->with('points',$points);
    }

    public function addpoint(Request $request) {
        $search = 'No Search';
        return view('backend/adminStore/member/addpoint')->with('search',$search);
    }

    public function addPointPost(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_addPoint(), $this->messages_addPoint());
        if($validator->passes()) {
            $point = $request->all();
            $point = Point::create($point);

            $request->session()->flash('alert-success', 'เพิ่มคะแนนสะสมสำเร็จ');
            return back();
        }else{
            $request->session()->flash('alert-danger', 'เพิ่มคะแนนสะสมไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
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
        return view('backend/adminStore/member/addpoint')->with('members',$members)
                                                         ->with('search',$search);
    }

    public function accountStaff(Request $request) {
        $NUM_PAGE = 15;
        $store_id = Auth::guard('admin-store')->id();
        $account_staffs = AccountStaff::where('store_id',$store_id)->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/adminStore/account-staff/dashboard')->with('NUM_PAGE',$NUM_PAGE)
                                                                 ->with('page',$page)
                                                                 ->with('account_staffs',$account_staffs);
    }

    public function createAccountStaff() {
        return view('backend/adminStore/account-staff/create-account');
    }

    public function createAccountStaffPost(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_createAccountStaff(), $this->messages_createAccountStaff());
        if($validator->passes()) {
            $account_staff = $request->all();
            $account_staff['password'] = bcrypt($account_staff['password_name']);
            $account_staff = AccountStaff::create($account_staff);

            $request->session()->flash('alert-success', 'สร้างบัญชีพนักงานสำเร็จ');
            return redirect()->action('Backend\AdminStoreController@accountStaff');
        }else{
            $request->session()->flash('alert-danger', 'สร้างบัญชีพนักงานไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();   
        }
    }

    public function searchMemberCoupon(Request $request) {
        return view('backend/adminStore/coupon/search-member');
    }

    public function coupon($id) {
        $search = 'No Search';
        $coupons = GetCoupon::where('member_id',$id)
                            ->join('campaigns', 'campaigns.id', '=', 'get_coupons.coupon_id')
                            ->select('campaigns.*', 'get_coupons.*','campaigns.status as status_coupon','get_coupons.status as status_get_coupon')
                            ->orderBy('get_coupons.id','desc')->get();
        $member_id = $id;
        return view('backend/adminStore/coupon/coupon-index')->with('search',$search)
                                                             ->with('member_id',$member_id)
                                                             ->with('coupons',$coupons);
    }

    public function searchCoupon(Request $request) {
        $member_id = $request->get('member_id');
        $search = $request->get('code');

        $coupons = GetCoupon::where('member_id',$member_id)
                            ->join('campaigns', 'campaigns.id', '=', 'get_coupons.coupon_id')
                            ->where('campaigns.code', '=', $search)
                            ->select('campaigns.*', 'get_coupons.*','campaigns.status as status_coupon','get_coupons.status as status_get_coupon')
                            ->orderBy('get_coupons.id','desc')->get();

        return view('backend/adminStore/coupon/coupon-index')->with('coupons',$coupons)
                                                             ->with('search',$search)
                                                             ->with('member_id',$member_id);
    }

    public function searchMemberCouponPost(Request $request) {
        $search = $request->get('search');
        $members = Member::where('tel',$search)->get();
        $count = count($members);
            if($count == 0) {
                $search = '0';
            }
        return view('backend/adminStore/coupon/coupon')->with('members',$members)
                                                       ->with('search',$search);
    }

    public function useCoupon(Request $request, $id) {
        $member_id = GetCoupon::where('id',$id)->value('member_id');
        $get_coupon = GetCoupon::findOrFail($id);
        $get_coupon->status = 'ใช้งานแล้ว';
        $get_coupon->save();
        $request->session()->flash('alert-success', 'ใช้คูปองสำเร็จ');
        return back();
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
}
