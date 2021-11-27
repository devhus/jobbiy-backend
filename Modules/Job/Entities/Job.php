<?php

namespace Modules\Job\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Company\Entities\Company;
use Modules\User\Entities\User;

class Job extends Model
{
    protected $fillable = [
        'title',
        'location',
        'description',
        'enabled',
        'company_id',
    ];

    protected $casts = [
        'enabled' => 'boolean',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function aplications()
    {
        return $this->hasMany(JobApplication::class);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithCompany($query)
    {
        return $query->with('company');
    }

    /**
     * @return boolean
     */
    public function getHasAppliedAttribute()
    {
        $user = User::current();
        if (!$user) {
            return false;
        }
        return $user->jobApplications()->where('job_id', $this->id)->count() > 0;
    }
}
