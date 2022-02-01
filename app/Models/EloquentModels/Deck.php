<?php

declare(strict_types=1);

namespace App\Models\EloquentModels;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $incremental_id
 * @property string $id_hash
 * @property bool $active
 * @property bool $complete
 *
 * {@inheritdoc}
 * @method where($column, $operator = null, $value = null, $boolean = 'and')
 * @mixin EloquentModel
 * @mixin Builder
 */
class Deck extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'decks';

    /**
     * @var array<string>
     */
    protected $fillable = [
        'active',
        'complete',
    ];


    public function cards(): HasMany
    {
        return $this->hasMany(Card::class)->getResults();
    }
}
