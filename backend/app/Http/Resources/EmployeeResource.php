<?php
/**
 * Criado através de FileTemplate por Kevin.
 */

/**
 * Created by PhpStorm.
 * User: devmaker
 * Date: 15/10/18
 * Time: 12:48
 */

namespace App\Http\Resources;


use App\Models\Employee;

class EmployeeResource extends BaseResource
{
    /**
     * @param Employee $resource
     * @return array
     */
    public function toResource($resource): array
    {
        $data = [
            'id' => $resource->getKey(),
            'name' => $resource->name,
            'is_owner' => $resource->user_id == auth()->id()
        ];

        return $data;
    }
}
