<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\User\StoreUserRequest;
use App\Http\Requests\Api\V1\User\UpdateUserRequest;
use App\Http\Resources\Api\V1\UserResource;
use App\Models\User;
use App\Services\UserService;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->middleware('auth:sanctum');
        $this->userService = $userService;
    }

    /**
     * @OA\Get(
     *     path="/api/v1/users",
     *     tags={"User"},
     *     summary="Get user list",
     *     description="API returns the entire list of users",
     *     security={{"sanctum": {}}},
     *     @OA\Response(
     *       response=200,
     *       description="Success",
     *       @OA\JsonContent(
     *           type="array",
     *           @OA\Items(ref="#/components/schemas/User")
     *       )
     *    ),
     *     @OA\Response(
     *       response=401,
     *       description="Unauthorized",
     *       @OA\JsonContent(
     *           @OA\Property(property="success", type="boolean", example=false),
     *           @OA\Property(property="message", type="string", example="Unauthenticated")
     *       )
     *     )
     * )
     */

    public function index()
    {
        return UserResource::collection($this->userService->getAll());
    }

    /**
     * @OA\Get(
     *     path="/api/v1/users/{id}",
     *     tags={"User"},
     *     summary="Get user details",
     *     security={{"bearerAuth": {}}},
     *     description="API returns detailed information of a user",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="User ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not found"
     *     ),
     *     @OA\Response(
     *       response=401,
     *       description="Unauthorized",
     *       @OA\JsonContent(
     *           @OA\Property(property="success", type="boolean", example=false),
     *           @OA\Property(property="message", type="string", example="Unauthenticated")
     *       )
     *     )
     * )
     */
    public function show($id)
    {
        $user = $this->userService->getById($id);
        if (!$user) return response()->json(['success' => false, 'message' => 'Not found'], 404);
        return new UserResource($user);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/users",
     *     tags={"User"},
     *     summary="Create a new user",
     *     security={{"bearerAuth": {}}},
     *     description="API creates a new user",
     *     @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/UserCreateRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Created successfully"
     *     ),
     *     @OA\Response(
     *       response=401,
     *       description="Unauthorized",
     *       @OA\JsonContent(
     *           @OA\Property(property="success", type="boolean", example=false),
     *           @OA\Property(property="message", type="string", example="Unauthenticated")
     *       )
     *     )
     * )
     */
    public function store(StoreUserRequest $request)
    {
        $user = $this->userService->create($request->validated());
        return (new UserResource($user))->additional(['message' => 'Created successfully']);
    }

    /**
     * @OA\Put(
     *     path="/api/v1/users/{id}",
     *     tags={"User"},
     *     security={{"bearerAuth": {}}},
     *     summary="Update user information",
     *     description="API updates information of a user",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="User ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/UserUpdateRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Updated successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not found"
     *     ),
     *     @OA\Response(
     *       response=401,
     *       description="Unauthorized",
     *       @OA\JsonContent(
     *           @OA\Property(property="success", type="boolean", example=false),
     *           @OA\Property(property="message", type="string", example="Unauthenticated")
     *       )
     *     )
     * )
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = $this->userService->getById($id);
        if (!$user) return response()->json(['success' => false, 'message' => 'Not found'], 404);
        $this->userService->update($user, $request->validated());

        return new UserResource($user);
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/users/{id}",
     *     tags={"User"},
     *     security={{"bearerAuth": {}}},
     *     summary="Delete a user",
     *     description="API deletes a user",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="User ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not found"
     *     ),
     *     @OA\Response(
     *       response=401,
     *       description="Unauthorized",
     *       @OA\JsonContent(
     *           @OA\Property(property="success", type="boolean", example=false),
     *           @OA\Property(property="message", type="string", example="Unauthenticated")
     *       )
     *     )
     * )
     */
    public function destroy($id)
    {
        $user = $this->userService->getById($id);
        if (!$user) return response()->json(['success' => false, 'message' => 'Not found'], 404);
        $this->userService->delete($user);
        return response()->json(['success' => true, 'message' => 'Deleted successfully']);
    }
}
