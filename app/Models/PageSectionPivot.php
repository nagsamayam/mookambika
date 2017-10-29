<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PageSectionPivot extends Pivot
{
    public function getContentAttribute($content)
    {
        return json_decode($content);
    }
}
