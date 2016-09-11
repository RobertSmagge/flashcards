<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
    protected $fillable = [
        'naam',
        'folder_id',
    ];

    /**
     * Define the relation with the folder.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }

    /**
     * Define the relation with the cards.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function cards()
    {
        return $this->belongsToMany(Card::class)
            ->withTimestamps()->withPivot('order');
    }
}
