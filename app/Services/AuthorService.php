<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class AuthorService {
    use ConsumesExternalService;

    /**
     * The base uri to consume the authors service
     * @var string
     */
    public $baseUri;

    /**
     * The secret to consume the books service
     * @var string
     */
    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.authors.base_uri');
        $this->secret = config('services.authors.secret');
    }

    /**
     * Obtain the full list of authors from the author service
     * @return string
     */
    public function obtainAuthors(){
        return $this->performRequest('GET', '/authors');
    }

    /**
     * Create a new author from the author service
     * @return string
     */
    public function createAuthor($data){
        return $this->performRequest('POST', '/authors', $data);
    }

    /**
     * Obtain one specific author from the author service
     * @return string
     */
    public function obtainAuthor($author){
        return $this->performRequest('GET', "/authors/{$author}");
    }

    /**
     * Update information of one specific author from the author service
     * @return string
     */
    public function editAuthor($data, $author){
        return $this->performRequest('PUT', "/authors/{$author}", $data);
    }

    /**
     * Deletes one specific author from the author service
     * @return string
     */
    public function deleteAuthor($author){
        return $this->performRequest('DELETE', "/authors/{$author}");
    }
}
