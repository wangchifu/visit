<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Lab404\Impersonate\Models\Impersonate;

class User extends Authenticatable
{
    use Notifiable;
    use Impersonate;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'password',
        'login_type',
        'name',
        'group_id',
        'admin',
        'township',
        'address',
        'telephone_number',
        'email',
        'line_id',
        'website',
        'disable',
        'intro_ztan',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function school_data()
    {
        return $this->hasOne(SchoolData::class);
    }

    public function vendor_data()
    {
        return $this->hasOne(VendorData::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }

}
