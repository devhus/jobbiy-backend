<?php

namespace Modules\Company\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Job\Entities\Job;
use Modules\User\Entities\User;

class Company extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'location',
        'industry',
        'website',
        'type',
        'founded_at',
    ];

    protected $casts = [
        'founded_at' => 'datetime',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}
