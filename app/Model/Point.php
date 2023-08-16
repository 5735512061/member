<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
	protected $table = 'points';

	protected $fillable = [
    	'member_id', 'branch_id', 'bill_number', 'date', 'price'
    ];

    protected $primaryKey = 'id';
}
