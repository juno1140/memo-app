<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
    use HasFactory;

    public const PRIORITY_LOW = 1;
    public const PRIORITY_MIDDLE = 2;
    public const PRIORITY_HIGH = 3;
    public const PRIORITIES = [
        self::PRIORITY_LOW    => '★',
        self::PRIORITY_MIDDLE => '★★',
        self::PRIORITY_HIGH   => '★★★',
    ];

    protected $guarded = ['id'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'deadline' => 'datetime',
    ];
}
