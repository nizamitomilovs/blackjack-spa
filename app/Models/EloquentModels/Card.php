<?php

declare(strict_types=1);

namespace App\Models\EloquentModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model as EloquentModel;

/**
 * @property int $id
 * @property string $id_hash
 * @property string $value
 * @property string $suit
 * @property string $deck_id
 *
 * {@inheritdoc}
 * @method where($column, $operator = null, $value = null, $boolean = 'and')
 * @mixin EloquentModel
 * @mixin Builder
 */
class Card extends EloquentModel
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cards';

    /**
     * @var array<string>
     */
    protected $fillable = [
        'value',
        'suit',
        'deck_id'
    ];

    public function deck(): BelongsTo
    {
        return $this->belongsTo(Deck::class);
    }
}
