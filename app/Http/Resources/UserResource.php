<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     title="UserResource",
 *     description="User schema",
 *     @OA\Property(
 * 	       property="id",
 * 	       type="integer"
 * 	   ),
 * 	   @OA\Property(
 * 		   property="email",
 * 		   type="string",
 *         format="email"
 * 	   ),
 *     @OA\Property(
 * 		   property="name",
 * 		   type="string"
 * 	   ),
 *     @OA\Property(
 * 		   property="phone",
 * 		   type="string"
 * 	   )
 * )
 */
class UserResource extends JsonResource
{
    public static $wrap = null;

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'name' => $this->name,
            'phone' => $this->phone,
        ];
    }
}
