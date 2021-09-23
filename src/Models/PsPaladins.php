<?php

namespace Anibalealvarezs\Paladins\Models;

use Spatie\Translatable\HasTranslations;

class PsPaladins extends PsBuilder
{
    use HasTranslations;

    protected $table = 'paladins';

    public $translatable = ['description', 'alt'];

    protected $appends = ['crud', 'url'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'alt', 'mime_type', 'hash', 'module', 'permission', 'user_id'
    ];
}
