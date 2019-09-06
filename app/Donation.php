<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'donationType',
        'emailAddress',
        'fullName',
        'paymentType',
        'donationAmount'
    ];
}
