<?php

namespace App\Swagger\Schemas;

/**
 * @OA\Schema(
 *     schema="UserCreateRequest",
 *     type="object",
 *     required={"name", "email", "password"},
 *     @OA\Property(property="name", type="string", example="Nguyễn Văn A"),
 *     @OA\Property(property="email", type="string", format="email", example="nva@example.com"),
 *     @OA\Property(property="password", type="string", format="password", example="12345678")
 * )
 */
class UserCreateRequest {}
