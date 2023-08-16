<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
	protected $table = 'rewards';

	protected $fillable = [
    	'name', 'reward_tyre', 'detail', 'tier', 'status', 'image'
    ];

    protected $primaryKey = 'id';
}
