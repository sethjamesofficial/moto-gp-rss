<?php

namespace App\Models;

use App\Models\Channel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }
}
