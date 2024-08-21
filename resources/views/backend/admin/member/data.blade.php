@php
    // min_price, max_price ระดับสมาชิก
    $min_price_standard = DB::table('tiers')
        ->where('tier', 'STANDARD')
        ->value('min_price');
    $max_price_standard = DB::table('tiers')
        ->where('tier', 'STANDARD')
        ->value('max_price');
    $min_price_premium = DB::table('tiers')
        ->where('tier', 'PREMIUM')
        ->value('min_price');
    $max_price_premium = DB::table('tiers')
        ->where('tier', 'PREMIUM')
        ->value('max_price');
    $min_price_supreme = DB::table('tiers')
        ->where('tier', 'SUPREME')
        ->value('min_price');
@endphp
@foreach ($members as $member => $value)
    @php
        $sumprice = DB::table('points')
            ->where('member_id', $value->id)
            ->sum('price');
        $culPrice = floor($sumprice / 100);
        
        // หักคะแนนจากการแลกของรางวัล
        $redeem_reward_point = DB::table('redeem_rewards')
            ->join('reward_points', 'reward_points.id', '=', 'redeem_rewards.point_id')
            ->where('member_id', $value->id)
            ->sum('reward_points.point');
        
        // หักคะแนนแลกสิทธิ์ร้านค้าพันธมิตร
        $redeem_point = DB::table('redeem_points')
            ->join('partner_shop_points', 'partner_shop_points.id', '=', 'redeem_points.point_id')
            ->where('member_id', $value->id)
            ->sum('partner_shop_points.point');
        
        $point_balance = $culPrice - $redeem_reward_point - $redeem_point;
    @endphp
    <tr style="text-align:center;">
        <td>{{ $member + 1 }}</td>     
        <td>{{ $value->serialnumber }}</td>
        <td>{{ $value->tel }}</td>
        <td>{{ $value->name }} {{ $value->surname }}</td>
        <td>{{ $point_balance }}</td>
        @if ($sumprice == $min_price_standard || $sumprice < $max_price_standard)
            <td>STANDARD</td>
        @elseif($sumprice == $min_price_premium || $sumprice < $max_price_premium)
            <td>PREMIUM</td>
        @elseif($sumprice > $min_price_supreme)
            <td>SUPREME</td>
        @endif
        <td>{{ $value->date }}</td>
        @if ($value->status == 'ONLINE')
            <td>
                <button class="btn btn-success btn-sm my-auto" style="color:#fff;">
                    {{ $value->status }}
                </button>
            </td>
        @else
            <td>
                <button class="btn btn-danger btn-sm my-auto" style="color:#fff;">
                    {{ $value->status }}
                </button>
            </td>
        @endif
        <td>
            <a href="{{ url('member/profile') }}/{{ $value->id }}"
                class="mt-2 btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                    class="ni ni-bold-right" aria-hidden="true"></i></a>
        </td>
    </tr>
@endforeach
