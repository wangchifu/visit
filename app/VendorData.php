<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorData extends Model
{
    protected $table = "vendor_datas";

    protected $fillable = [
        'vendor_name',
        'about',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
