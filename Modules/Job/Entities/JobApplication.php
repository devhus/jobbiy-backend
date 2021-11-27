<?php

namespace Modules\Job\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\User;

class JobApplication extends Model
{
    protected $fillable = [
        'user_id',
        'job_id',
        'status',
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithUser($query)
    {
        return $query->with(['user' => function ($q) {
            return $q->select('id', 'name', 'email');
        }]);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWhereEmployerJob($query, $jobId, $userId)
    {
        return $query->whereHas('job', function ($q) use ($jobId, $userId) {
            $q->where('id', $jobId)
                ->whereHas('company', function ($qq) use ($userId) {
                    $qq->where('user_id', $userId);
                });
        });
    }
}
