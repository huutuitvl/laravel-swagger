<?php

namespace App\Swagger\Schemas;

/**
 * @OA\Schema(
 *     schema="User",
 *     type="object",
 *     title="User",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Nguyễn Văn A"),
 *     @OA\Property(property="email", type="string", example="nva@example.com"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-04-20T12:34:56Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-04-20T12:34:56Z")
 * )
 */
class User {}
