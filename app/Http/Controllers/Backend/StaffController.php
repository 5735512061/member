<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Member;
use App\Model\Point;
use App\Model\Campaign;
use App\Model\GetCoupon;

use Validator;
use Carbon\Carbon;

class StaffController extends Controller
{
    public function __construct(){
        $this->middleware('auth:staff');
    }

    public function dashboard(Request $request) {
        $NUM_PAGE = 10;
        $members = Member::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/staff/dashboard')->with('NUM_PAGE',$NUM_PAGE)
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
        return view('backend/staff/dashboard')->with('NUM_PAGE',$NUM_PAGE)
                                                   ->with('page',$page)
                                                   ->with('members',$members)
                                                   ->with('search',$search);
    }

    public function memberProfile(Request $request, $id) {
        $member = Member::findOrFail($id);
        return view('backend/staff/member/member-profile')->with('member',$member);
    }

    public function addpoint(Request $request) {
        $search = 'No Search';
        return view('backend/staff/member/addpoint')->with('search',$search);
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

    public function searchMember(Request $request) {
        $search = $request->get('search');
        $members = Member::where('tel',$search)->get();
        $count = count($members);
            if($count == 0) {
                $search = '0';
            }
        return view('backend/staff/member/addpoint')->with('members',$members)
                                                    ->with('search',$search);
    }

    public function registerMember(Request $request) {
        return view('backend/staff/member/register');
    }

    public function registerMemberPost(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_register(), $this->messages_register());
        if($validator->passes()) {
            // ข้อมูลของตาราง members
            $random = rand(1111111111111111,9999999999999999);  
            $serialnumber = wordwrap($random , 4 , '-' , true );

            $card_id = $request->get('card_id');
            $title = $request->get('title');
            $name = $request->get('name');
            $surname = $request->get('surname');
            $bday = $request->get('bday');
            $tel = $request->get('tel');
            $status = $request->get('status');
            $password = $request->get('tel');
            $date = Carbon::now()->format('d/m/Y');

            $member = new Member;
            $member->serialnumber = $serialnumber;
            $member->card_id = $card_id;
            $member->title = $title;
            $member->name = $name;
            $member->surname = $surname;
            $member->bday = $bday;
            $member->tel = $tel;
            $member->date = $date;
            $member->status = $status;
            $member->password = $password;
            $member->save();

            $request->session()->flash('alert-success', 'ลงทะเบียนสมัครสมาชิกสำเร็จ');
            return back();
        }
        else{
                $request->session()->flash('alert-danger', 'สมัครสมาชิกไม่สำเร็จ กรุณากรอกข้อมูลให้ถูกต้องครบถ้วน');
                return redirect('/staff/register-member')->withErrors($validator)->withInput();   
            }
    }

    public function searchMemberCoupon(Request $request) {
        return view('backend/staff/coupon/search-member');
    }

    public function coupon($id) {
        $search = 'No Search';
        $coupons = GetCoupon::where('member_id',$id)
                            ->join('campaigns', 'campaigns.id', '=', 'get_coupons.coupon_id')
                            ->select('campaigns.*', 'get_coupons.*','campaigns.status as status_coupon','get_coupons.status as status_get_coupon')
                            ->orderBy('get_coupons.id','desc')->get();
        $member_id = $id;
        return view('backend/staff/coupon/coupon-index')->with('search',$search)
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

        return view('backend/staff/coupon/coupon-index')->with('coupons',$coupons)
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
        return view('backend/staff/coupon/coupon')->with('members',$members)
                                                  ->with('search',$search);
    }

    public function useCoupon(Request $request, $id) {
        $dateNow = Carbon::now()->format('d/m/Y');
        $member_id = GetCoupon::where('id',$id)->value('member_id');
        $get_coupon = GetCoupon::findOrFail($id);
        $get_coupon->status = 'ใช้งานแล้ว';
        $get_coupon->date_use_coupon = $dateNow;
        $get_coupon->save();
        $request->session()->flash('alert-success', 'ใช้คูปองสำเร็จ');
        return back();
    }

    public function rules_register() {
        return [
            'serialnumber' => 'unique:members',
            'card_id' => 'required|unique:members',
            'name' => 'required',
            'surname' => 'required',
            'bday' => 'required',
            'tel' => 'required|unique:members',
            'address' => 'required',
            'district' => 'required',
            'amphoe' => 'required',
            'province' => 'required',
            'zipcode' => 'required',
        ];
    }

    public function messages_register() {
        return [
            'serialnumber.unique' => 'หมายเลขสมาชิกใช้ในการลงทะเบียนแล้ว',
            'card_id.required' => 'กรุณากรอกหมายเลขบัตรประชาชน',
            'card_id.unique' => 'หมายเลขบัตรประชาชนใช้ในการลงทะเบียนแล้ว',
            'name.required' => 'กรุณากรอกชื่อ',
            'surname.required' => 'กรุณากรอกนามสกุล',
            'bday.required' => 'กรุณากรอกวันเดือนปีเกิด',
            'tel.required' => 'กรุณากรอกเบอร์โทรศัพท์',
            'tel.unique' => 'เบอร์โทรศัพท์ใช้ในการลงทะเบียนแล้ว',
            'address.required' => 'กรุณากรอกที่อยู่',
            'district.required' => 'กรุณากรอกตำบล',
            'amphoe.required' => 'กรุณากรอกอำเภอ',
            'province.required' => 'กรุณากรอกจังหวัด',
            'zipcode.required' => 'กรุณากรอกรหัสไปรษณีย์',
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
