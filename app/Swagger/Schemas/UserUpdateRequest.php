<?php

namespace App\Swagger\Schemas;

/**
 * @OA\Schema(
 *     schema="UserUpdateRequest",
 *     type="object",
 *     @OA\Property(property="name", type="string", example="Nguyễn Văn B"),
 *     @OA\Property(property="email", type="string", example="nva_b@example.com")
 * )
 */
class UserUpdateRequest {}
