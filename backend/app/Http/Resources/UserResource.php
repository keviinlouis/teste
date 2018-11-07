<?php
/**
 * Criado através de FileTemplate por Kevin.
 */

/**
 * Created by PhpStorm.
 * User: devmaker
 * Date: 15/10/18
 * Time: 12:47
 */

namespace App\Http\Resources;


use App\Models\User;

class UserResource extends BaseResource
{
    public function __construct($resource, $withToken = false)
    {
        parent::__construct($resource);
        $this->withToken = $withToken;
    }

    /**
     * @param User $resource
     * @return array
     */
    public function toResource($resource): array
    {
        $data = [
            'id' => $resource->getKey(),
            'name' => $resource->name,
            'email' => $resource->email
        ];

        return $data;
    }
}
