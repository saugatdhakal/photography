<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerTransation extends Model
{
    use HasFactory;
    protected $fillables = [
        'photo_id',
        'transaction_id',
        'delivery_status'
    ];
}
