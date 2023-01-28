<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     title="PaymentResource",
 *     description="Payment schema",
 *     @OA\Property(
 * 	       property="id",
 * 	       type="integer"
 * 	   ),
 * 	   @OA\Property(
 * 		   property="amount",
 * 		   type="integer"
 * 	   ),
 *     @OA\Property(
 * 		   property="date",
 * 		   type="string",
 *         format="date-time"
 * 	   ),
 * )
 */
class PaymentResource extends JsonResource
{
    public static $wrap = null;

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'amount' => $this->amount,
            'date' => $this->created_at,
        ];
    }
}
