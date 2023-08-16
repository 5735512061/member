<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable 
{
    use Notifiable;
    protected $table = 'members';

    protected $guard = 'member';


    protected $fillable = [
        'serialnumber', 'card_id', 'title', 'name', 'surname', 'bday', 'tel', 'date', 'password', 'status',
    ];

    protected $primaryKey = 'id';

    protected $hidden = [
        'password', 'remember_token',
    ];

}
