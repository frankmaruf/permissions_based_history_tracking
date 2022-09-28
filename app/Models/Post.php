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
    public function scopeStatus(Builder $query)
    {
        return $query->where('status', 1);
    }
}
