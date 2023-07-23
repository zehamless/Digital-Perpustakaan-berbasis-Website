<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with('category')->get();
//        return response()->json([
//            'message'=>'Berhasil menampilkan buku',
//            'books'=>$books,
//        ], 200);
        return view('library.dashboard', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('library.user.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'amount'=>'required',
            'cover'=>'required|image|mimes:png,jpg,jpeg|max:2048',
            'file'=>'required|mimes:pdf,doc,docx,xls,xlsx|max:2048',
            'category_id'=>'required',
        ]);
        $cover = $request->file('cover')->store('covers', 'public');
        $file = $request->file('file')->store('files', 'public');
        $book = new Book;
        $book->title = $request->title;
        $book->description = $request->description;
        $book->amount = $request->amount;
        $book->cover = $cover;
        $book->file_path = $file;
        $book->category_id = $request->category_id;
        $book->user_id = Auth::id();
        $book->save();
//        return response()->json([
//            'message'=>'Buku berhasil ditambahkan',
//            'book'=>$book,
//        ], 201);
        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $query= Book::with('category');
            if ($request->filled('category_id')){
                $query->where('category_id', $request->category_id);
                            }
            $books = $query->get();
        $categories = Category::all();
        if ($request->wantsJson()) {
            return response()->json($books);
        } else {
            $categories = Category::all();
            return view('library.user.bookshelf', compact('books', 'categories'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        if ($book->user_id !== Auth::id() and Auth::user()->role !== 'admin') {
            // Redirect the user back with an error message or perform some other action
            return redirect()->back()->with('error', 'You are not authorized to edit this book.');
        }

        $categories = Category::all();
        return view('library.user.update', compact('book', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'amount'=>'required',
            'cover'=>'image|mimes:png,jpg,jpeg|max:2048',
            'file'=>'mimes:pdf,doc,docx,xls,xlsx|max:2048',
            'category_id'=>'required',
        ]);
        $book = Book::find($book->id);

        // new Cover
        if ($request->file('cover')) {
            $oldCover = $book->cover;
            if (Storage::exists('public/' . $oldCover)) {
                Storage::delete('public/' . $oldCover);
            }
            $cover = $request->file('cover')->store('covers', 'public');
            $book->cover = $cover;
        }
        // new File
        if ($request->file('file')) {
            $oldFile = $book->file_path;
            if (Storage::exists('public/' . $oldFile)) {
                Storage::delete('public/' . $oldFile);
            }
            $file = $request->file('file')->store('files', 'public');
            $book->file_path = $file;
        }
        $book->title = $request->title;
        $book->description = $request->description;
        $book->amount = $request->amount;
        $book->save();

//        return response()->json([
//            'message'=>'Buku berhasil diupdate',
//            'book'=>$book,
//        ], 200);

        return redirect()->route('books.index')->with('success', 'Buku berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {

        if (Storage::exists('public/' . $book->cover)) {
            Storage::delete('public/' . $book->cover);
        }
        if (Storage::exists('public/' . $book->file_path)) {
            Storage::delete('public/' . $book->file_path);
        }
        $book->delete();
//        return response()->json([
//            'message'=>'Buku berhasil dihapus',
//        ], 200);
        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus');
    }

    public function exportPdf()
    {
        $query = Book::with('category');
        if (Auth::user()->role === 'admin') {
            // Redirect the user back with an error message or perform some other action
            $books = $query->get();
        }
        else {
            $books = $query->where('user_id', Auth::id())->get();
        }
        $pdf = PDF::loadView('library.export', compact('books'));
        return $pdf->download('books.pdf');
    }
}
