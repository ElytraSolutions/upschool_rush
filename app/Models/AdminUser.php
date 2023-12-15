<?php

namespace App\Models;

use App\Traits\AdminHasPermissions;
use OpenAdmin\Admin\Traits\DefaultDatetimeFormat;
use App\Models\User;


class AdminUser extends User
{
    use AdminHasPermissions;
    use DefaultDatetimeFormat;


    protected $table = 'users';
}
