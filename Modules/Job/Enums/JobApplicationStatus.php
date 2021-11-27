<?php
namespace Modules\Job\Enums;

use App\Helpers\EnumBase;

class JobApplicationStatus extends EnumBase
{
    const PENDING  = 'pending';
    const REJECTED = 'rejected';
    const ACCEPTED = 'accepted';
}
