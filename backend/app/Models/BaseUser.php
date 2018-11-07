<?php

namespace App\Models;

use App\Traits\AttributesMasks;
use App\Traits\Files;
use App\Traits\Password;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

abstract class BaseUser extends Authenticatable implements JWTSubject
{
	use AttributesMasks, Password, Files;

    /**
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * @return array
     */
    public function getJWTCustomClaims() : array
    {
        return [
            'class' => static::class
        ];
    }
}
