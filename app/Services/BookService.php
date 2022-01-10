<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class BookService {
    use ConsumesExternalService;

    /**
     * The base uri to consume the books service
     * @var string
     */
    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.books.base_uri');
    }

    /**
     * Obtain the full list of books from the book service
     * @return string
     */
    public function obtainBooks(){
        return $this->performRequest('GET', '/books');
    }

    /**
     * Create a new book from the book service
     * @return string
     */
    public function createBook($data){
        return $this->performRequest('POST', '/books', $data);
    }

    /**
     * Obtain one specific book from the book service
     * @return string
     */
    public function obtainBook($book){
        return $this->performRequest('GET', "/books/{$book}");
    }

    /**
     * Update information of one specific book from the book service
     * @return string
     */
    public function editBook($data, $book){
        return $this->performRequest('PUT', "/books/{$book}", $data);
    }

    /**
     * Deletes one specific book from the book service
     * @return string
     */
    public function deleteBook($book){
        return $this->performRequest('DELETE', "/books/{$book}");
    }
}
