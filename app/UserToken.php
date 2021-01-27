<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserToken extends Model
{
    protected $table = 'user_tokens';
    protected $primaryKey = 'token';
    protected $keyType = 'string';
    public $incrementing = false;    
    
    protected $fillable = ['user_id', 'token'];

    /* 
        METODOS CON LOS MODELOS
    */

    public function user(){
        return $this->belongsTo(User::class);
    }

}
