<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use App\Models\LegacyLoadout;

class Player extends Eloquent
{
  protected $table = "players";
  protected $connection = "mongodb";
    
	protected $fillable = [
      'membership_type', 'membership_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'updated_at', 'created_at'
    ];

	public function loadouts(){
		return $this->hasMany(Loadout::class);
	}
}
