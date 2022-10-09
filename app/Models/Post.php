<?php

namespace App\Models;

use App\History\Traits\Historyable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory,Historyable;
    protected $casts = [
        'status' => 'boolean',
    ];
    protected $fillable = [
        'title', 'body',
    ];
    public function scopeStatus(Builder $query)
    {
        return $query->where('status', 1);
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
