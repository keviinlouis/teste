<?php
/**
 * Created by PhpStorm.
 * User: DevMaker
 * Date: 29/03/2018
 * Time: 14:06
 */

namespace App\Traits;


trait Password
{
    /**
     * @param String $password
     */
    public function setPasswordAttribute(String $password) : void
    {
        $this->attributes['password'] = \Hash::make($password);
    }

    public function checkPassword(string $password)
    {
        return \Hash::check($password, $this->password);
    }
}
