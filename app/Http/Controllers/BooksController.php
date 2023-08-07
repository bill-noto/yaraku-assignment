<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class BooksController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'authorId' => 'required'
        ]);

        Book::create($request->all());

        return $this->index();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $authors = Author::all();

        return Inertia::render('BooksCreate', [
            'authors' => $authors
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $books = Book::all();
        $authors = Author::all();

        return Inertia::render('BooksIndex', [
            'books' => $books,
            'authors'=> $authors
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return Inertia::render('BookEdit', [
            'book' => Book::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'authorId' => 'required'
        ]);

        $book = Book::find($id);

        $book->update($request->all());

        return $this->show($id);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
//        $author = Book::find($id)->author->name;

        return Inertia::render('BookShow', [
            'book' => Book::find($id),
        ]);
    }

    /**
     * Search for a resource by author or title and opens the resource
     *
     * @param Request $request
     * @return Response
     */
    public function search(Request $request)
    {
        $bookToReturn = '';
        $bookList = '';

        if ($request->name) {
            $bookToReturn = Book::findByName($request->name);

            return Inertia::render('BookShow', [
                'books' => $bookToReturn
            ]);
        } else {
            $bookList = Book::findByAuthorId($request->authorId);

            return Inertia::render('BookShow', [
                'books' => $bookList
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);

        if ($book) Book::destroy($id);

        return $this->index();
    }
}
