<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    const PER_PAGE_DEFAULT = 20;

    const PER_PAGE_MIN = 5;

    const PER_PAGE_MAX = 50;

    /**
     * Get the number of records to show in the listing.
     *
     * @return int
     */
    public function getPaginationLimit(): int
    {
        $perPage = request()->query('per_page', self::PER_PAGE_DEFAULT);

        if ($perPage < self::PER_PAGE_MIN) {
            $perPage = self::PER_PAGE_MIN;
        } elseif ($perPage > self::PER_PAGE_MAX) {
            $perPage = self::PER_PAGE_MAX;
        }

        return $perPage;
    }
}
