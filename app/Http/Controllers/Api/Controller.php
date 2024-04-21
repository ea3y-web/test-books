<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller as BaseController;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Simple REST API application OpenAPI Documentation",
 *      description="Description of REST routes to work with books OpenAPI (generated with L5 Swagger).",
 *      @OA\Contact(
 *          email="admin@admin.com"
 *      ),
 *      @OA\License(
 *          name="Apache 2.0",
 *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *      )
 * )
 *
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="Demo API Server"
 * )
 *
 * @OA\Tag(
 *      name="Books",
 *      description="API Endpoints of Books"
 * )
 */
class Controller extends BaseController { }
