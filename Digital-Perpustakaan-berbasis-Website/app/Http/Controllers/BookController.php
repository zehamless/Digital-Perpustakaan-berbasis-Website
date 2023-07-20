<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::orderBy('created_at', 'DESC')->get();
        return response()->json([
            'message'=>'Berhasil menampilkan buku',
            'books'=>$books,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        return response()->json([
            'message'=>'Buku berhasil ditambahkan',
            'book'=>$book,
        ], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
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
            'cover'=>'required|image|mimes:png,jpg,jpeg|max:2048',
            'file'=>'required|mimes:pdf,doc,docx,xls,xlsx|max:2048',
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

        return response()->json([
            'message'=>'Buku berhasil diupdate',
            'book'=>$book,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book = Book::find($book->id);
        $oldCover = $book->cover;
        $oldFile = $book->file_path;
        if (Storage::exists('public/' . $oldCover)) {
            Storage::delete('public/' . $oldCover);
        }
        if (Storage::exists('public/' . $oldFile)) {
            Storage::delete('public/' . $oldFile);
        }
        $book->delete();
        return response()->json([
            'message'=>'Buku berhasil dihapus',
        ], 200);
    }
}
