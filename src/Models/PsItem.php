<?php

namespace Anibalealvarezs\Paladins\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PsItem extends PsBuilder
{
    protected $table = 'items';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'item_id', 'description', 'device_name', 'icon_id', 'price', 'short_desc', 'champion_id', 'icon_url',
        'type', 'recharge_seconds', 'ret_msg', 'talent_reward_level'
    ];

    /**
     * Get the menu that owns the dish.
     */
    public static function getInstanceByItemId($id)
    {
        $self = self::where('item_id', $id)->first();
        if ($self) {
            return self::find($self->id)->with('champion');
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
            'item_id' => 'ItemId',
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
