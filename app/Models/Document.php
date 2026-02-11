<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
   use HasFactory;
   protected $fillable = ['path', 'file_size', 'file_type', 'created_at', 'updated_at'];

   public function documentable(){
      return $this->morphTo();
   }
}
