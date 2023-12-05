<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function getNameAttribute()
    {
        ///get the full name
        return $this->first_name . " " . $this->last_name;
    }
    public function getAdminRevenueAttribute()
    {
        ////short function get sum of admin revenue.
        return $this->orderItems->sum(fn (OrderItem $item) => $item->admin_revenue);
    }
}
