<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RedeemPoint extends Model
{
	protected $table = 'redeem_points';

	protected $fillable = [
    	'member_id', 'partner_id', 'promotion_id', 'point_id', 'date', 'code'
    ];

    protected $primaryKey = 'id';
}
