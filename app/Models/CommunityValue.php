<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityValue extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function language()
    {
        return $this->hasMany(Language::class, 'language_id', 'id');
    }

    public function details(){
        return $this->hasOne(CommunityValueDetails::class, 'community_value_id', 'id');
    }

}
