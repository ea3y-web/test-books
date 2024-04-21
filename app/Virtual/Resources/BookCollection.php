<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *      title="BookCollection",
 *      description="Book collection",
 *      type="object"
 * )
 */
class BookCollection
{
    /**
     * @OA\Property(
     *      title="Data",
     *      description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Resources\BookResource[]
     */
    private $data;

    /**
     * @OA\Property(
     *      title="Links",
     *      description="Listing navigation"
     * )
     *
     * @var \App\Virtual\Resources\Links
     */
    private $links;

    /**
     * @OA\Property(
     *      title="Meta",
     *      description="Pagination meta data"
     * )
     *
     * @var \App\Virtual\Resources\Meta
     */
    private $meta;
}
