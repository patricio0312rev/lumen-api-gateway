<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Services\AuthorService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
        $authors = Author::all();

        return $this->successResponse($authors);
    }

    /**
     * Create one new author.
     *
     * @return Illuminate/Http/Response
     */
    public function store(Request $request){
        $rules = [
            'name' => 'required|string|max:255',
            'gender' => 'required|string|max:255|in:male,female',
            'country' => 'required|string|max:255',
        ];

        $this->validate($request, $rules);

        $author = Author::create($request->all());

        return $this->successResponse($author, Response::HTTP_CREATED);
    }

    /**
     * Obtains and shows and author.
     *
     * @return Illuminate/Http/Response
     */
    public function show($author){
        $author = Author::findOrFail($author);

        return $this->successResponse($author);
    }

    /**
     * Updates an existing author
     *
     * @return Illuminate/Http/Response
     */
    public function update(Request $request, $author){
        $rules = [
            'name' => 'string|max:255',
            'gender' => 'string|max:255|in:male,female',
            'country' => 'string|max:255',
        ];

        $this->validate($request, $rules);

        $author = Author::findOrFail($author);

        $author->fill($request->all());

        if($author->isClean()) {
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $author->save();

        return $this->successResponse($author);
    }

    /**
     * Removes and existing author
     *
     * @return Illuminate/Http/Response
     */
    public function destroy($author){
        $author = Author::findOrFail($author);
        $author->delete();

        return $this->successResponse($author);
    }
}
