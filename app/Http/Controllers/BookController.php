<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->user()->cannot('viewAny', Book::class)) {
            return [
                'success' => false,
                'message' => 'You are not authorized to view books.',
            ];
        }
        return [
            'success' => true,
            'data' => Book::all()->where('active', true),
        ];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Done from frontend
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        //
        if ($request->user()->cannot('create', Book::class)) {
            return response([
                'success' => false,
                'message' => 'You are not authorized to create books.',
            ], 403);
        }
        $validated = $request->validated();
        $validated['slug'] = Str::slug($validated['title']);
        $book = Book::create($validated);
        return [
            'success' => true,
            'data' => $book,
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Book $book)
    {
        //
        if ($request->user()->cannot('view', $book)) {
            return response([
                'success' => false,
                'message' => 'You are not authorized to view book.',
            ], 403);
        }
        return [
            'success' => true,
            'data' => $book,
        ];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        // Done from frontend
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        //
        if ($request->user()->cannot('update', $book)) {
            return response([
                'success' => false,
                'message' => 'You are not authorized to update book.',
            ], 403);
        }
        $validated = $request->validated();
        if (isset($validated['title'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }
        $book->update($validated);
        $book->save();
        return [
            'success' => true,
            'data' => $book,
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Book $book = null)
    {
        //
        if ($request->user()->cannot('delete', $book)) {
            return response([
                'success' => false,
                'message' => 'You are not authorized to delete book.',
            ], 403);
        }
        return [
            'success' => true,
            'data' => $book,
        ];
    }
}
