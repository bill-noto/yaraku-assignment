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
    public function store(Request $request): Response
    {
        $request->validate([
            'title' => 'required',
            'author_id' => 'required'
        ]);

        Book::create($request->all());

        return $this->index();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
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
    public function index(): Response
    {
        $books = Book::all();
        $authors = Author::all();

        return Inertia::render('BooksIndex', [
            'books' => $books,
            'authors' => $authors
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit(int $id): Response
    {
        $authors = Author::all();

        return Inertia::render('BooksEdit', [
            'authors' => $authors,
            'books' => Book::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, int $id): Response
    {
        $request->validate([
            'title' => 'required',
            'author_id' => 'required'
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
    public function show(int $id): Response
    {
        return Inertia::render('BooksShow', [
            'books' => Book::find($id),
        ]);
    }

    /**
     * Search for a resource by author or title and opens the resource
     *
     * @param Request $request
     * @return Response
     */
    public function search(Request $request): Response
    {
        $authors = Author::all();

        if ($request->name) {
            $bookToReturn = Book::byTitle($request->title)->first();

            return Inertia::render('BooksIndex', [
                'books' => $bookToReturn,
                'authors' => $authors
            ]);
        } else {
            $bookList = Book::byAuthorId($request->author_id)->get();

            return Inertia::render('BooksIndex', [
                'books' => $bookList,
                'authors' => $authors
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(int $id): Response
    {
        $book = Book::find($id);

        if ($book) Book::destroy($id);

        return $this->index();
    }
}
