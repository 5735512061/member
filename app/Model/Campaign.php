<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
	protected $table = 'campaigns';

	protected $fillable = [
    	'partner_id', 'code', 'name', 'campaign_type', 'start_date', 'expire_date','detail', 'image', 'status'
    ];

    protected $primaryKey = 'id';
}
