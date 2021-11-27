<?php
namespace Modules\User\Enums;

use App\Helpers\EnumBase;

class Permissions extends EnumBase
{
    const APPLY_TO_JOBS         = 'apply_to_jobs';
    const ACCESS_EMPLOYER_PANEL = 'access_employer_panel';
    const CREATE_JOBS           = 'create_jobs';
    const ACCESS_ADMIN_PANEL    = 'access_admin_panel';
}
