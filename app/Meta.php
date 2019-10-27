<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Meta
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Meta newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Meta newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Meta query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $route
 * @property string $type
 * @property string $image
 * @property string $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Meta whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Meta whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Meta whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Meta whereRoute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Meta whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Meta whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Meta whereValue($value)
 */
class Meta extends Model
{
    const MAIN_PAGE = '/';
    const VIEW_TYPES = ['partner', 'contact'];

    protected $table = 'meta';
    protected $attributes = ['route' => self::MAIN_PAGE];
}
