<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Services\AuthorService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class AuthorController extends Controller
{
    use ApiResponser;

    /**
     * The service to consume the author microservice
     * @var AuthorService
     */
    public $authorService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    /**
     * Returns the list of authors.
     *
     * @return Illuminate/Http/Response
     */
    public function index(){
        return $this->successResponse($this->authorService->obtainAuthors());
    }

    /**
     * Create one new author.
     *
     * @return Illuminate/Http/Response
     */
    public function store(Request $request){
        return $this->successResponse($this->authorService->createAuthor($request->all(), Response::HTTP_CREATED));
    }

    /**
     * Obtains and shows and author.
     *
     * @return Illuminate/Http/Response
     */
    public function show($author){
        return $this->successResponse($this->authorService->obtainAuthor($author));
    }

    /**
     * Updates an existing author
     *
     * @return Illuminate/Http/Response
     */
    public function update(Request $request, $author){
        return $this->successResponse($this->authorService->editAuthor($request->all(), $author));
    }

    /**
     * Removes and existing author
     *
     * @return Illuminate/Http/Response
     */
    public function destroy($author){
        return $this->successResponse($this->authorService->deleteAuthor($author));
    }
}
