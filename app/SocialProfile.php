<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialProfile extends Model
{
    protected $fillable = ['user_id', 'social_network_user_id', 'social_network'];

    public static $allowed = ['facebook', 'github', 'google'];
    
    /* 
        METODOS CON LOS MODELOS
    */

    public function user(){
        return $this->belongsTo(User::class);
    }
}
