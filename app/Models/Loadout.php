<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Loadout extends Eloquent
{
  protected $table = "loadouts";
  protected $connection = "mongodb";
	protected $fillable = [
        'assignedId', 'name', 'equipped', 'unequipped', 'emblemHash'
    ];
  protected $hidden = [
    "_id", "player_id"
  ];

  public function owner(){
    return $this->hasOne(Player::class, '_id', 'player_id');
  }
}
