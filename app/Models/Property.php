<?php
// app/Models/Property.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'address',
        'price',
        'area',
        'land_area',
        'rooms',
        'floor',
        'building_type',
        'type',
        'images',
        'user_id',
        'is_active'
    ];

    protected $casts = [
        'images' => 'array',
        'is_active' => 'boolean',
        'price' => 'decimal:2'
    ];

    /**
     * Связь с пользователем (риэлтором/агентом)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
public function getAgentNameAttribute()
{
    return $this->user ? $this->user->name : 'Агентство Меридиан';
}

public function getAgentPhoneAttribute()
{
    return $this->user && $this->user->phone ? $this->user->phone : '+7 (901) 150-08-79';
}

public function getAgentTelegramAttribute()
{
    return $this->user ? $this->user->telegram : null;
}

public function getAgentWhatsappAttribute()
{
    return $this->user ? $this->user->whatsapp : null;
}

public function getAgentVkAttribute()
{
    return $this->user ? $this->user->vk : null;
}
    /**
     * Алиас для совместимости
     */
    public function realtor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Связь с избранным
     */
    public function savedBy()
    {
        return $this->hasMany(SavedProperty::class);
    }

    /**
     * Получить первое изображение или заглушку
     */
    public function getFirstImageAttribute()
    {
        if ($this->images && count($this->images) > 0) {
            return asset('storage/' . $this->images[0]);
        }

        if ($this->type == 'house') {
            return 'https://images.unsplash.com/photo-1568605114967-8130f3a36994?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';
        } elseif ($this->type == 'plot') {
            return 'https://images.unsplash.com/photo-1500382017468-9049fed747ef?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';
        }

        return 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';
    }

    /**
     * Форматированная цена
     */
    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 0, '.', ' ') . ' ₽';
    }
}
