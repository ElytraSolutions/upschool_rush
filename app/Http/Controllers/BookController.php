<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use Illuminate\Http\UploadedFile;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $validated['book_author'] = $request->user()->id;
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
        } catch (\Exception $e) {
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

        $filename = uuid_create();
        Storage::disk('s3')->put('books/' . $filename, $book);


        return [
            'success' => true,
            'data' => $reponse
        ];
    }


    /**
     * @lrd:start
     * @lrd:end
     */
    public function addCategory(Request $request)
    {
        try {
            $categories = $request['categories'];
            $book = Book::find($request['book']);
            $book->categories()->sync($categories);
            $book_categories = Book::find($request['book'])->categories;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }



        return [
            'success' => true,
            'data' => $book_categories
        ];
    }


    public function list(Request $request)
    {
        $per_page = intval($request->per_page) ?? 10;
        $books = Book::select('*');
        try {
            if ($request->search) {
                $search = $request->search;
                $books = $books->where(function ($query) use ($search) {
                    $query->where('title', 'LIKE', '%' . $search . '%')
                        ->orWhere('first_name', 'LIKE', '%' . $search . '%')
                        ->orWhere('country', 'LIKE', '%' . $search . '%');
                });
            }

            if ($request->categories) {
                $categories = $request->categories;
                $books = $books->whereHas('categories', function ($query) use ($categories) {
                    $query->whereIn('categories.id', $categories);
                });
            }
            $books = $books->paginate($per_page);



            $response['data'] = BookResource::collection($books)->map(
                function ($resource) {
                    return $resource->only(['id', 'title', 'description', 'country', 'first_name', 'categories']);
                }
            );

            if ($request->page > 1) {
                $count = $per_page * $request->page - $per_page + 1;
            } else {
                $count = 1;
            }

            $response['pagination'] = [
                'total_number' => $books->total(),
                'count' => $count,
                'per_page' => $per_page,
                'current_page' => $books->currentPage(),
                'last_page' => $books->lastPage(),
            ];

            $response['message'] = "Data fetched.";
            $response['error'] = null;
            $response['status'] = 200;
            return response()->json($response, $response['status']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }


    public function bestSeller(Request $request)
    {
        $per_page = $request->per_page ?? 10;
        $query = Book::select('*');
        try {
            $books = $query->where('is_best_seller', '=', 'YES')->paginate($per_page);
            $response['data'] = BookResource::collection($books)->map(
                function ($resource) {
                    return $resource->only(['id', 'title', 'description', 'country', 'first_name']);
                }
            );
            if ($request->page > 1) {
                $count = $per_page * $request->page - $per_page + 1;
            } else {
                $count = 1;
            }
            $response['pagination'] = [
                'total_number' => $books->total(),
                'count' => $count,
                'per_page' => $per_page,
                'current_page' => $books->currentPage(),
                'last_page' => $books->lastPage(),
            ];

            $response['message'] = "Data fetched.";
            $response['error'] = null;
            $response['status'] = 200;
            return response()->json($response, $response['status']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function featured(Request $request)
    {
        $per_page = $request->per_page ?? 10;
        $query = Book::select('*');
        try {
            $books = $query->where('is_featured', '=', 'YES')->paginate($per_page);
            $response['data'] = BookResource::collection($books)->map(
                function ($resource) {
                    return $resource->only(['id', 'title', 'description', 'country', 'first_name']);
                }
            );
            if ($request->page > 1) {
                $count = $per_page * $request->page - $per_page + 1;
            } else {
                $count = 1;
            }
            $response['pagination'] = [
                'total_number' => $books->total(),
                'count' => $count,
                'per_page' => $per_page,
                'current_page' => $books->currentPage(),
                'last_page' => $books->lastPage(),
            ];

            $response['message'] = "Data fetched.";
            $response['error'] = null;
            $response['status'] = 200;
            return response()->json($response, $response['status']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function detail($id)
    {
        try {
            $book = Book::where('id', $id)->first();
            if ($book) {
                $response['data'] = new BookResource($book);
                $response['message'] = 'Data Fetched';
                $response['error'] = null;
                $response['status'] = 200;
                return response()->json($response, $response['status']);
            } else {
                $response['data'] = null;
                $response['message'] = null;
                $response['error'] = 'Invalid id';
                $response['status'] = 400;
                return response()->json($response, $response['status']);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
