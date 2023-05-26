<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vendorID extends Model
{
    protected $table = 'level';
    protected $fillable = [
        'id_vendor','vendor_name','vendor_address', 'logo'
    ];

}
