<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Company\Entities\Company;
use Modules\Job\Entities\JobApplication;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $guard_name = 'api';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_employer',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_employer'       => 'boolean',
    ];

    /**
     * @return static|null
     */
    public static function current()
    {
        $user = auth('sanctum')->user();
        return $user ? $user : null;
    }

    public function company()
    {
        return $this->hasOne(Company::class);
    }

    //! if an account can create more than one company so,
    //! the relation will be changed to this method instead of company().
    //! with this case we will have to use the crud controller within
    //! the Account module to modify the user's company list.
    // public function companies()
    // {
    //     return $this->hasMany(Company::class);
    // }

    public function jobApplications()
    {
        return $this->hasMany(JobApplication::class);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithCompany($query)
    {
        return $query->with(['company']);
    }
}
