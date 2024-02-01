<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

trait LogsActivityTrait
{
    public function logActivity($description)
    {
        $domain = str_replace(['https://','http://',':3000'], '', request()->headers->get('Origin'));
        $db = DB::connection('central');
        $db->table('activity_logs')->insert([
            'user_id' => auth()->id(),
            'domain' => $domain,
            'description' => $description,
            'ip_address' => request()->ip(),
            'created_at' => now(),
        ]);
    }
}
