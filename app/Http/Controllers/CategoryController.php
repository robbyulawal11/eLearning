<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Category::orderBy('updated_at', 'desc')->paginate(10);
        // dd($data);
        return view('admin/pages/CategoryManagement/show', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin/pages/CategoryManagement/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'namaKategori' => 'required',
            'descKategori' => 'required'
        ]);

        Category::create($validator);
        return redirect('admin/category')->with('success', 'Data berhasil diinput');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Category::find($id);

        return view('admin/pages/CategoryManagement/edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Category::find($id);

        $validator = $request->validate([
            'namaKategori' => 'required',
            'descKategori' => 'required'
        ]);

        $data->update($validator);
        return redirect('admin/category')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Category::find($id);
        $data->delete();
        return redirect('admin/category')->with('success', 'Data berhasil dihapus');
    }
}
