<?php

namespace App\Enums;

/**
 * @OA\Schema(
 *      title="Genre",
 *      description="Genre of book",
 *      type="string"
 * )
 */
enum Genre: string
{
    case FANTASY = "Fantasy";

    case SCIFI = "Science fiction";

    case MYSTERY = "Mystery";

    case HORROR = "Horror";

    case ROMANCE = "Romance novel";

    case THRILLER = "Thriller";

    case AUTOBIO = "Autobiography";

    case ADVENTURE = "Adventure";

    case HISTORY = "History";

    case BIOGRAPHY = "Biography";

    case DRAMA = "Drama";

    case HUMOR = "Humor";
}
