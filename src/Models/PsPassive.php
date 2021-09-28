<?php

namespace Anibalealvarezs\Paladins\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class PsPassive extends PsBuilder
{
    protected $table = 'passives';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'description', 'device_name', 'icon_id', 'price', 'short_desc', 'champion_id', 'icon_url',
        'type', 'recharge_seconds', 'ret_msg', 'talent_reward_level'
    ];

    /**
     * Get the menu that owns the dish.
     */
    public function champion(): BelongsTo
    {
        return $this->belongsTo(PsChampion::class);
    }

    public function matchPlayers(): MorphToMany
    {
        return $this->morphedByMany(PsMatchPlayer::class, 'passivable', 'passivables', 'passive_id', 'passivable_id');
    }

    public function players(): MorphToMany
    {
        return $this->morphedByMany(PsPlayer::class, 'ppassivable', 'ppassivables', 'passive_id', 'ppassivable_id');
    }

    public static function equivalences()
    {
        return [
            'id' => 'ItemId',
            'description' => 'Description',
            'device_name' => 'DeviceName',
            'icon_id' => 'IconId',
            'price' => 'Price',
            'short_desc' => 'ShortDesc',
            'champion_id' => 'champion_id',
            'icon_url' => 'itemIcon_URL',
            'type' => 'item_type',
            'recharge_seconds' => 'recharge_seconds',
            'ret_msg' => 'ret_msg',
            'talent_reward_level' => 'talent_reward_level',
        ];
    }
}
