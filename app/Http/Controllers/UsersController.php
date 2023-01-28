<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserPaymentRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\DeleteUserRequest;
use App\Http\Requests\GetUserPaymentsRequest;
use App\Http\Requests\ShowUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\PaymentResource;
use App\Http\Resources\UserResource;
use App\Services\PaymentService;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UsersController extends Controller
{
    public function __construct(
        private UserService $userService,
        private PaymentService $paymentService,
    ) {
        //
    }

    /**
     * @OA\Get(
     *     path="/users",
     *     description="Users list",
     *     tags={"Users"},
     *     security={{"passport": {"*"}}},
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/UserResource")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     )
     * )
     */
    public function index(): AnonymousResourceCollection
    {
        $users = $this->userService->list();

        return UserResource::collection($users);
    }

    /**
     * @OA\Get(
     *     path="/users/{id}",
     *     description="User details",
     *     tags={"Users"},
     *     security={{"passport": {"*"}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="User id",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(ref="#/components/schemas/UserResource")
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden"
     *     )
     * )
     */
    public function show(ShowUserRequest $request): UserResource
    {
        $user = $this->userService->get($request->route('id'));

        return new UserResource($user);
    }

    /**
     * @OA\Post(
     *     path="/users",
     *     description="Create a user",
     *     tags={"Users"},
     *     security={{"passport": {"*"}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"email", "name", "phone"},
     *             @OA\Property(
     * 	        	   property="email",
     * 	        	   type="string",
     *                 format="email"
     * 	           ),
     *             @OA\Property(
     * 	        	   property="name",
     * 	        	   type="string"
     * 	           ),
     *             @OA\Property(
     * 	        	   property="phone",
     * 	        	   type="string"
     * 	           )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="id",
     *                 type="integer"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation errors"
     *     )
     * )
     */
    public function create(CreateUserRequest $request): JsonResponse
    {
        $id = $this->userService->create($request->toDto());

        return response()->json([
            'id' => $id,
        ]);
    }

    /**
     * @OA\Patch(
     *     path="/users/{id}",
     *     description="Update a user",
     *     tags={"Users"},
     *     security={{"passport": {"*"}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="User id",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"email", "name", "phone"},
     *             @OA\Property(
     * 	        	   property="email",
     * 	        	   type="string",
     *                 format="email"
     * 	           ),
     *             @OA\Property(
     * 	        	   property="name",
     * 	        	   type="string"
     * 	           ),
     *             @OA\Property(
     * 	        	   property="phone",
     * 	        	   type="string"
     * 	           )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="success",
     *                 type="boolean"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation errors"
     *     )
     * )
     */
    public function update(UpdateUserRequest $request): JsonResponse
    {
        $this->userService->update($request->toDto());

        return response()->json([
            'success' => true,
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/users/{id}",
     *     description="Delete a user",
     *     tags={"Users"},
     *     security={{"passport": {"*"}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="User id",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="success",
     *                 type="boolean"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden"
     *     )
     * )
     */
    public function delete(DeleteUserRequest $request): JsonResponse
    {
        $this->userService->delete($request->route('id'));

        return response()->json([
            'success' => true,
        ]);
    }

    /**
     * @OA\Get(
     *     path="/users/{id}/payments",
     *     description="User payments list",
     *     tags={"Users"},
     *     security={{"passport": {"*"}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="User id",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/PaymentResource")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden"
     *     )
     * )
     */
    public function payments(GetUserPaymentsRequest $request): AnonymousResourceCollection
    {
        $payments = $this->paymentService->list($request->route('id'));

        return PaymentResource::collection($payments);
    }

    /**
     * @OA\Post(
     *     path="/users/{id}/payments",
     *     description="Create a payment for user",
     *     tags={"Users"},
     *     security={{"passport": {"*"}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="User id",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"amount"},
     *             @OA\Property(
     * 		           property="amount",
     * 		           type="integer"
     * 	           )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="id",
     *                 type="integer"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation errors"
     *     )
     * )
     */
    public function createPayment(CreateUserPaymentRequest $request): JsonResponse
    {
        $id = $this->paymentService->create($request->toDto());

        return response()->json([
            'id' => $id,
        ]);
    }
}
