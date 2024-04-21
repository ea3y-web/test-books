<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *      title="Links",
 *      description="Listing links data",
 *      type="object"
 * )
 */
class Links
{
    /**
     * @OA\Property(
     *      title="First link",
     *      description="Link to the first page of listing",
     *      example="http://localhost/api/books?page=1"
     * )
     *
     * @var string
     */
    public $first;

    /**
     * @OA\Property(
     *      title="Last link",
     *      description="Link to the last page of listing",
     *      example="http://localhost/api/books?page=5"
     * )
     *
     * @var string
     */
    public $last;

    /**
     * @OA\Property(
     *      title="Prev link",
     *      description="Link to the previous page of listing",
     *      example="http://localhost/api/books?page=1"
     * )
     *
     * @var string|null
     */
    public $prev;

    /**
     * @OA\Property(
     *      title="Prev link",
     *      description="Link to the next page of listing",
     *      example="http://localhost/api/books?page=2"
     * )
     *
     * @var string|null
     */
    public $next;
}
