<?php

namespace App\Utilities;

use App\Models\Setting;
use App\Models\Theme;

class Template {

    public static function core()
    {
        $data['theme'] = Theme::first();
        $data['setting'] = Setting::first();

        return $data;
    }
}
