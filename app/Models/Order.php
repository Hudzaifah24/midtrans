<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // protected $table = 'db_midtrans';

    protected $guarded = [];

    // protected $fillable = [
    //     'status_code',
    //     'status_transaction',
    //     'transaction_id',
    //     'order_id',
    //     'gross_amount',
    //     'payment_type',
    //     'payment_code',
    //     'pdf_url',
    // ];
}
