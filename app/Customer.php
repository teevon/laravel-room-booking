<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    // variables in the fillable array can be mass assigned
    // protected $fillable = ["name", 'title', "email", "active"];

    //variables in the guarded array cannot be mass assigned, opp of fillable
    protected $guarded = [];

    protected $attributes  = [
        "active" => 0
    ];

    public function getActiveAttribute($attribute) {
        return $this->activeOptions()[$attribute];
    }

    public function scopeActive($query) {
        return $query->where('active', 1);
    }

    public function company() {
        return $this->belongsTo(Company::class);
    }

    public function activeOptions() {
        return [
            1 => 'Active',
            0 => 'Inactive',
            2 => 'In Progress'
        ];
    }
}
