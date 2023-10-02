@php
    // min_price, max_price ระดับสมาชิก
    $min_price_silver = DB::table('tiers')
        ->where('tier', 'SILVER')
        ->value('min_price');
    $max_price_silver = DB::table('tiers')
        ->where('tier', 'SILVER')
        ->value('max_price');
    $min_price_gold = DB::table('tiers')
        ->where('tier', 'GOLD')
        ->value('min_price');
    $max_price_gold = DB::table('tiers')
        ->where('tier', 'GOLD')
        ->value('max_price');
    $min_price_platinam = DB::table('tiers')
        ->where('tier', 'PLATINAM')
        ->value('min_price');
    $max_price_platinam = DB::table('tiers')
        ->where('tier', 'PLATINAM')
        ->value('max_price');
    $min_price_diamond = DB::table('tiers')
        ->where('tier', 'DIAMOND')
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
        @if ($sumprice == $min_price_silver || $sumprice < $max_price_silver)
            <td>SILVER</td>
        @elseif($sumprice == $min_price_gold || $sumprice < $max_price_gold)
            <td>GOLD</td>
        @elseif($sumprice == $min_price_platinam || $sumprice < $max_price_platinam)
            <td>PLATINAM</td>
        @elseif($sumprice > $min_price_diamond)
            <td>DIAMOND</td>
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
