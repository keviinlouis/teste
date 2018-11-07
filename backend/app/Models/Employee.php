<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 15 Oct 2018 15:43:21 +0000.
 */

namespace App\Models;

use App\Models\BaseModel as Eloquent;

/**
 * Class Employee
 *
 * @property int $id
 * @property string $name
 * @property string $status
 * @property int $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereUserId($value)
 * @mixin \Eloquent
 */
class Employee extends Eloquent
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 2;

    public static $snakeAttributes = false;

	protected $casts = [
		'user_id' => 'int'
	];

	protected $fillable = [
		'name',
		'status',
		'user_id'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

    /**
     * @return array
     * @throws \ReflectionException
     */
    public static function getStatus()
    {
        return self::getConstants('STATUS');
	}
}
