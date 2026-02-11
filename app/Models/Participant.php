<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $table = 'participants';
    protected $guarded = [];


    public function documents(){
        return $this->morphMany(Document::class, 'documentable');
    }

    public function manager(){
        return $this->belongsTo(User::class, 'manager_id');
    }

}
