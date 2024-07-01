<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Course::orderBy('updated_at', 'desc')->paginate(10);
        $category = Category::all();
        return view('admin/pages/CourseManagement/show', compact('data', 'category'));
    }

    public function sendVideoFromDatabase($id)
    {
        // Ambil data video dari database
        $video = Course::findOrFail($id);
        $videoName = $video->video;
        // Dapatkan path video dari storage
        $videoPath = Storage::disk('public')->path('videos/courses' . $videoName);

        dd($videoPath);

        // Kirim permintaan POST ke API eksternal dengan file dan nama video
        $response = Http::attach(
            'video_url', file_get_contents($videoPath), basename($videoPath)
        )->post('https://functionappai11.azurewebsites.net/api/myhttptrigger', [
            'video_name' => $video->name,
        ]);

        // Cek apakah permintaan berhasil
        if ($response->successful()) {
            return response()->json(['message' => 'Video uploaded successfully', 'data' => $response->json()]);
        }

        return response()->json(['error' => 'Failed to upload video'], 500);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        return view('admin/pages/CourseManagement/create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'video' => 'required',
            'transcript' => 'nullable',
            'summary' => 'nullable',
            'category_id' => 'required',
        ]);

        if ($request->hasFile('video')) {
            $filename = time().'.'.$request->video->extension();
            $request->video->move(public_path('storage/videos/courses'), $filename);
            $validator['video'] = $filename;
        }

        Course::create($validator);
        return redirect('admin/course')->with('success', 'Data course berhasil diinput');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::all();
        $data = Course::find($id);
        return view('admin/pages/CourseManagement/detail', compact('data','category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Course::find($id);
        $category = Category::all();
        return view('admin/pages/CourseManagement/edit', compact('data', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Course::find($id);

        $validator = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'video' => 'nullable',
            'transcript' => 'nullable',
            'summary' => 'nullable',
        ]);

        if ($request->hasFile('video')) {
            //menghapus video lama
            $imagePath = public_path('storage/videos/courses/' . $data->video);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            //menyimpan video baru
            $fileName = time().'.'.$request->video->extension();
            $request->video->move(public_path('storage/videos/courses/'), $fileName);
            $validator['video'] = $fileName;
        }

        $data->update($validator);
        return redirect('admin/course')->with('success', 'Data course berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Course::find($id);
        $videoPath = public_path('images/galeries/' . $data->video);
        if (file_exists($videoPath)) {
            unlink($videoPath);
        }
        Course::destroy($id);
        return redirect('admin/course')->with('success', 'Data course berhasil dihapus');
    }
}
