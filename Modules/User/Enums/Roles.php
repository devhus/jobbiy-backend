<?php
namespace Modules\User\Enums;

use App\Helpers\EnumBase;

class Roles extends EnumBase
{
    const ADMIN    = 'admin';
    const EMPLOYER = 'employer';
    const EMPLOYEE = 'employee';
}
