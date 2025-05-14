<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * الخصائص القابلة للتعبئة الجماعية.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * الخصائص التي يجب إخفاؤها عند التحويل إلى مصفوفة أو JSON.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * تحويل الأنواع تلقائيًا.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
