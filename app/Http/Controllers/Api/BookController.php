<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\StoreBookRequest;
use App\Http\Requests\Api\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\JsonResponse;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    /**
     * @OA\Get(
     *      path="/books",
     *      operationId="getBooksList",
     *      tags={"Books"},
     *      summary="Get list of books",
     *      description="Returns list of books",
     *      @OA\Parameter(
     *          name="per_page",
     *          description="Number of records on the page in paginated listing (min: 5, max: 50)",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="integer",
     *              default=20,
     *              minimum=5,
     *              maximum=50
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="page",
     *          description="Number of the page in paginated listing",
     *          required=false,
     *          in="query",
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/BookCollection")
     *      )
     * )
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
    /**
     * @OA\Post(
     *      path="/books",
     *      operationId="storeBook",
     *      tags={"Books"},
     *      summary="Store new book",
     *      description="Returns book data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreBookRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/BookResource")
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity"
     *      )
     * )
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
    /**
     * @OA\Get(
     *      path="/books/{id}",
     *      operationId="getBookById",
     *      tags={"Books"},
     *      summary="Get book data",
     *      description="Returns book data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Book id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/BookResource")
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity"
     *      )
     * )
     */
    public function show(Book $book): JsonResponse
    {
        return (new BookResource($book))->response();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateBookRequest  $request
     * @param  Book               $book
     * @return JsonResponse
     */
    /**
     * @OA\Patch(
     *      path="/books/{id}",
     *      operationId="updateBook",
     *      tags={"Books"},
     *      summary="Update existing book",
     *      description="Returns updated book data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Book id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateBookRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/BookResource")
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity"
     *      )
     * )
     */
    public function update(UpdateBookRequest $request, Book $book): JsonResponse
    {
        $data = $request->validated();
        $book->update($data);

        return (new BookResource($book))->response();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Book $book
     * @return JsonResponse
     */
    /**
     * @OA\Delete(
     *      path="/books/{id}",
     *      operationId="deleteBook",
     *      tags={"Books"},
     *      summary="Delete existing book",
     *      description="Deletes a books and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Book id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function destroy(Book $book): JsonResponse
    {
        $book->delete();

        return response()->json([], 204);
    }
}
