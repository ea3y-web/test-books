<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *      title="Meta",
 *      description="Listing meta data",
 *      type="object"
 * )
 */
class Meta
{
    /**
     * @OA\Property(
     *      title="Current page",
     *      description="Number of the current page of listing",
     *      example=1
     * )
     *
     * @var int
     */
    public $current_page;

    /**
     * @OA\Property(
     *      title="From",
     *      description="Number of the first record on the page out of the total number of records",
     *      example=1
     * )
     *
     * @var int
     */
    public $from;

    /**
     * @OA\Property(
     *      title="Last page",
     *      description="Number of the last page in listing",
     *      example=5
     * )
     *
     * @var int
     */
    public $last_page;

    /**
     * @OA\Property(
     *      title="Path",
     *      description="Base path to the current listing",
     *      example="http://localhost/api/books"
     * )
     *
     * @var string
     */
    public $path;

    /**
     * @OA\Property(
     *      title="Per page",
     *      description="Number of records to display on page in listing",
     *      example=20
     * )
     *
     * @var int
     */
    public $per_page;

    /**
     * @OA\Property(
     *      title="To",
     *      description="Number of the last record on the page out of the total number of records",
     *      example=20
     * )
     *
     * @var int
     */
    public $to;

    /**
     * @OA\Property(
     *      title="Total",
     *      description="Total number of the records in listing",
     *      example=100
     * )
     *
     * @var int
     */
    public $total;
}
