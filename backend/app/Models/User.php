<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 15 Oct 2018 15:43:21 +0000.
 */

namespace App\Models;

use App\Models\BaseUser as Eloquent;

/**
 * Class User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Illuminate\Database\Eloquent\Collection $orders
 * @property \Illuminate\Database\Eloquent\Collection $employees
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Order $orderActive
 */
class User extends Eloquent
{
	public static $snakeAttributes = false;

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'name',
		'email',
		'password'
	];

	public function orders()
	{
		return $this->hasMany(Order::class);
	}

	public function employees()
	{
		return $this->hasMany(Employee::class);
	}

    public function orderActive()
    {
        return $this->hasOne(Order::class)->where('status', Order::STATUS_CREATED);
	}
}
