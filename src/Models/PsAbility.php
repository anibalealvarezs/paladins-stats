<?php

namespace Anibalealvarezs\Paladins\Models;

class PsAbility extends PsBuilder
{
    protected $table = 'abilities';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'description', 'summary', 'url', 'damage_type', 'recharge_seconds', 'champion_id'
    ];

    /**
     * Get the menu that owns the dish.
     */
    public function champion(): BelongsTo
    {
        return $this->belongsTo(PsChampion::class);
    }

    public static function equivalences()
    {
        return [
            'description' => 'Description',
            'summary' => 'Summary',
            'url' => 'URL',
            'damage_type' => 'damageType',
            'recharge_seconds' => 'rechargeSeconds',
        ];
    }
}
