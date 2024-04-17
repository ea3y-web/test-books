<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $perPage = $this->getPaginationLimit();
        $books = Book::paginate($perPage)->withQueryString();

        return BookResource::collection($books)
            ->response()
            ->withoutLinksMeta();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreBookRequest $request
     * @return JsonResponse
     */
    public function store(StoreBookRequest $request): JsonResponse
    {
        $data = $request->validated();
        $book = Book::create($data);
        $location = route('api.books.show', $book);

        return (new BookResource($book))->response()->withHeaders([
           'Location' => $location
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Book $book
     * @return JsonResponse
     */
    public function show(Book $book): JsonResponse
    {
        return (new BookResource($book))->response();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }
}
