<?php

namespace App\Virtual\Requests;

/**
 * @OA\Schema(
 *      title="Update Book request",
 *      description="Update Book request body",
 *      type="object"
 * )
 */
class UpdateBookRequest
{
    /**
     * @OA\Property(
     *      title="Title",
     *      description="Title of the book",
     *      example="Laborum voluptatem officiis est et"
     * )
     *
     * @var string
     */
    public $title;

    /**
     * @OA\Property(
     *      title="Publisher",
     *      description="Publisher of the book",
     *      example="Zieme, Hauck and McClure"
     * )
     *
     * @var string
     */
    public $publisher;

    /**
     * @OA\Property(
     *      title="Author",
     *      description="Author of the book",
     *      example="Allen Brown"
     * )
     *
     * @var string
     */
    public $author;

    /**
     * @OA\Property(
     *      title="Genre",
     *      description="Genre of the book",
     *      example="Science fiction"
     * )
     *
     * @var \App\Enums\Genre
     */
    public $genre;

    /**
     * @OA\Property(
     *      title="Publication date",
     *      description="Publication date of the book",
     *      format="date",
     *      example="2024-04-20"
     * )
     *
     * @var string
     */
    public $publication_date;

    /**
     * @OA\Property(
     *      title="Words number",
     *      description="Number of words in the book",
     *      format="int32",
     *      example=100000
     * )
     *
     * @var integer
     */
    public $words_number;

    /**
     * @OA\Property(
     *      title="Price",
     *      description="Price of the book",
     *      example=9.99
     * )
     *
     * @var float
     */
    public $price;
}
