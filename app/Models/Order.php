<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id' ,
        'address_id' ,
        'order_price',
        'status'    
    ];

    protected $appends = [
        'order_date_forHumans',
        'order_statuses'
    ];

    public function getOrderStatusesAttribute()
    {
        return [
            'pending' => [
                'text' => 'In Sospeso',
                'color' => 'red-400'
            ],
            'processing' => [
                'text' => 'In Preparazione',
                'color' => 'yellow-600'
            ],
            'shipped' => [
                'text' => 'Spedito',
                'color' => 'gray-400'
            ],
            'completed' => [
                'text' => 'Consegnato',
                'color' => 'green-600'
            ]
        ];
    }


    public function getOrderDateForHumansAttribute()
    {
        Carbon::setLocale('it');
        $orderDateCarbon =  Carbon::parse($this->order_date);

        return $orderDateCarbon->diffForHumans();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function pizzas()
    {
        return $this->belongsToMany(Pizza::class)->withPivot('quantity'); 
    }

   

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }
}
