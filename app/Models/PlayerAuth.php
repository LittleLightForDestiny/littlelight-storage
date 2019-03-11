<?php

namespace App\Models;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class PlayerAuth extends Eloquent
{
  protected $table = "player_auth";
  protected $connection = "mongodb";
    
	protected $fillable = [
      'uuid', 'secret', 'player_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'uuid', 'secret', 'updated_at', 'created_at'
    ];

	public function player(){
		return $this->hasOne(Player::class, "_id", "player_id");
	}
}
