<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PartnerShop extends Model
{
	protected $table = 'partner_shops';

	protected $fillable = [
    	'name', 'store_name', 'type', 'tel', 'password', 'image', 'logo', 'scan', 'status'
    ];

    protected $primaryKey = 'id';
}
