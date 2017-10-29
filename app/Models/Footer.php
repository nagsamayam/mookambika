<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    /**
     * Get the page that owns the footer.
     */
    public function pages()
    {
        return $this->hasMany(Page::class);
    }
}
