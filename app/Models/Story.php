<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;
    protected $table = 'stories';

    protected $fillable = ['uuid', 'user_id', 'post_type', 'file', 'file_type','post_id'];

    public function user(){
        return $this->belongsTo(User::class , 'user_id');
    }
}
