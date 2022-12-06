<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Transaction extends Model
{
    use HasFactory;
    protected $fillables = [
        'cust_name',
        'cust_email',
        'payment_id',
        'payer_id',
        'amount',
        'currency',
        'payment_status'
    ];


}
