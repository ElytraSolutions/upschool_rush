<?php

namespace App\Http\Controllers;
use Illuminate\Http\UploadedFile;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use Illuminate\Http\Request;
use Smalot\PdfParser\Parser;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Public route
        if ($request->showAll) {
            return [
                'success' => true,
                'data' => Book::all(),
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
        // Public route
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
                'message' => 'You are not authorized to update this book.',
            ], 403);
        }
        $validated = $request->validated();
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
    public function destroy(Request $request, Book $book)
    {
        //
        if ($request->user()->cannot('delete', $book)) {
            return response([
                'success' => false,
                'message' => 'You are not authorized to delete this book.',
            ], 403);
        }
        return [
            'success' => true,
            'data' => $book->delete(),
        ];
    }



    public function validateData(Request $request)
    {
        try {


            $parser = new Parser();
            $book = $request->file('pdfFile');
            $pdf = $parser->parseFile($book);
            $pages = $pdf->getPages();
            $total_pages = count($pdf->getPages());
            $reponse = array();

            if ($total_pages % 2 == 0) {
                $reponse[] = array(
                    "label" => "The total number of pages in my book is an even number. (12, 14, 16, 18, 20, ...)",
                    "value" => true
                );
            } elseif ($total_pages % 2 != 0) {
                $reponse[] = array(
                    "label" => "The total number of pages in my book is an even number. (12, 14, 16, 18, 20, ...)",
                    "value" => false
                );
            }


            $a4_test = true;
            $blank_page = true;


            foreach ($pages as $key => $page) {
                $page_details = $page->getDetails();
                if ($total_pages - 1 == $key or $key + 1 == 2) {

                    if (count($page_details["Resources"]) > 0) {
                        $blank_page = false;
                    }
                }

                $page_width = $page_details["MediaBox"][2];
                $page_height = $page_details["MediaBox"][3];

                if ($page_width != 841.92 && $page_height != 603.12) {
                    $a4_test = false;
                }
            }

        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

        $reponse[] = array(
            "label" => "My book is A4 size (210mm x 297mm)",
            "value" => $a4_test
        );

        $reponse[] = array(
            "label" => "Book has blank page after the front cover and another before the back cover.",
            "value" => $blank_page
        );


        return [
            'success' => true,
            'data' => $reponse
        ];
    }



public function addCategory(Request $request)
{
    try {
            $categories = $request['categories'];
            $book = Book::find($request['book']);
            $book->categories()->sync($categories);
            $book_categories = Book::find($request['book'])->categories;
    }
    catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 400);
    }



    return [
        'success' => true,
        'data' => $book_categories
    ];
}



public function addProject(Request $request)
{
    try {
        $projects = $request['projects'];
        $book = Book::find($request['book']);
        $book->projects()->sync($projects);
        $book_project = Book::find($request['book'])->projects;
    }
    catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 400);
    }



    return [
        'success' => true,
        'data' => $book_project
    ];
}
}

