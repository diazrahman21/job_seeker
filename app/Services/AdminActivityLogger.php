<?php

namespace App\Services;

use App\Models\Admin;
use App\Models\AdminLog;
use Illuminate\Database\Eloquent\Model;

class AdminActivityLogger
{
    public static function log(Admin $admin, string $action, Model $target = null, array $metadata = []): AdminLog
    {
        return AdminLog::create([
            'admin_id' => $admin->id,
            'action' => $action,
            'target_type' => $target ? $target::class : null,
            'target_id' => $target?->id,
            'metadata' => $metadata ?: null,
        ]);
    }
}
