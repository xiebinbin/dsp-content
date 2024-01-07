<?php

namespace App\Models;

use Dcat\Admin\Models\Administrator;

class AdminUser extends Administrator
{
    public function sites()
    {
        return $this->hasMany(Site::class);
    }
}
