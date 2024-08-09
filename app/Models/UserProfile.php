<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'country_id',
        'state_id',
        'city_id',
        'phone',
        'address',
        'photo',
        'gender'
    ];


      // Relationship with User
      public function user()
      {
          return $this->belongsTo(User::class);
      }

      // Relationship with Country
      public function country()
      {
          return $this->belongsTo(Country::class);
      }

      // Relationship with State
      public function state()
      {
          return $this->belongsTo(State::class);
      }

      // Relationship with City
      public function city()
      {
          return $this->belongsTo(City::class);
      }

}
