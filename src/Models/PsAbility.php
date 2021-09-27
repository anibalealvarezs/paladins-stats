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
        'ability_id', 'name', 'description', 'summary', 'url', 'damage_type', 'recharge_seconds', 'champion_id'
    ];

    /**
     * Get the menu that owns the dish.
     */
    public static function getInstanceByAbilityId($id)
    {
        $self = self::where('ability_id', $id)->first();
        if ($self) {
            return self::find($self->id)->with(['champion']);
        }
        return false;
    }

    /**
     * Get the menu that owns the dish.
     */
    public function champion(): BelongsTo
    {
        return $this->belongsTo(PsChampion::class, 'champion_id', 'champion_id');
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
