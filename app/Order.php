<?php

namespace App;

use Illuminate\Database\Query\Builder;
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

    /**
     * Get the latest orders.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeLatest($query)
    {
        return $query->orderID()->monthly();
    }

    /**
     * Order orders by id desc.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeOrderID($query)
    {
        return $query->orderBy('id', 'desc');
    }

    /**
     * Get orders of the month.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeMonthly($query)
    {
        return $query->whereMonth('created_at', date('m'));
    }

    public static function totalMonth()
    {
        return Order::monthly()->sum('total');
    }

    public static function totalMonthCount()
    {
        return Order::monthly()->count();
    }
}
