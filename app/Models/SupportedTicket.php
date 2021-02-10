<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportedTicket extends Model
{
    use HasFactory;

    protected $fillable = ['question'];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
