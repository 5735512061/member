<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class PartnerShop extends Authenticatable
{
	use Notifiable;

	protected $table = 'partner_shops';

	protected $guard = 'partner';

	protected $fillable = [
    	'name', 'tel', 'password', 'type', 'status'
    ];

    protected $primaryKey = 'id';

	protected $hidden = [
        'password', 'remember_token',
    ];
}
