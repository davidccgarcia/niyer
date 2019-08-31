<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * Generate guide number.
     */
    public function guideNumber()
    {
        return (string) Str::uuid();
    }

    /**
     * Get the total of the order.
     */
    public function total()
    {
        return number_format($this->total, 3);
    }
}
