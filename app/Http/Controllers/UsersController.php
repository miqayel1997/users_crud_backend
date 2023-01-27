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

    public function index(): AnonymousResourceCollection
    {
        $users = $this->userService->list();

        return UserResource::collection($users);
    }

    public function show(ShowUserRequest $request): UserResource
    {
        $user = $this->userService->get($request->route('id'));

        return new UserResource($user);
    }

    public function create(CreateUserRequest $request): JsonResponse
    {
        $id = $this->userService->create($request->toDto());

        return response()->json([
            'id' => $id,
        ]);
    }

    public function update(UpdateUserRequest $request): JsonResponse
    {
        $this->userService->update($request->toDto());

        return response()->json([
            'success' => true,
        ]);
    }

    public function delete(DeleteUserRequest $request): JsonResponse
    {
        $this->userService->delete($request->route('id'));

        return response()->json([
            'success' => true,
        ]);
    }

    public function payments(GetUserPaymentsRequest $request): AnonymousResourceCollection
    {
        $payments = $this->paymentService->list($request->route('id'));

        return PaymentResource::collection($payments);
    }

    public function createPayment(CreateUserPaymentRequest $request): JsonResponse
    {
        $id = $this->paymentService->create($request->toDto());

        return response()->json([
            'id' => $id,
        ]);
    }
}
