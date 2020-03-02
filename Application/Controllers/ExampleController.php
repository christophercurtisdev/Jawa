<?php
namespace Application\Controllers;

use JAWA\JAWAController;
use JAWA\JAWAView;

class ExampleController extends JAWAController
{
    //If entity is mapping books
    public function displayAll()
    {
        return $this->index();
    }

    public function addBook()
    {
        return $this->create();
    }

    public function saveDetails(array $book, int $id = null)
    {
        if($id)
        {
            return $this->update($id, $book);
        } else {
            return $this->store($book);
        }
    }

    public function addManyBooks(array $books)
    {
        return $this->createMany($books);
    }
}