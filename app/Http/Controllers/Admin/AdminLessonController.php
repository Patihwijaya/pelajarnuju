<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminLessonController extends Controller
{
    public function index()
    {
        $lessons = Lesson::with('classroom')->latest()->paginate(20);
        return view('admin.lessons.index', compact('lessons'));
    }

    public function create()
    {
        $classes = Classroom::all();
        return view('admin.lessons.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'class_id' => 'required|exists:classes,id',
            'judul' => 'required|string|max:225',
            'konten' => 'nullable|string',
            'file' => 'nullable|file|max:10240',
            'video_url' => 'nullable|string',
            'gambar' => 'nullable|image|max:4096',
            'order' => 'nullable|integer'
        ]);

        if($request->hasFile('file')){
            $data['file'] = $request->file('file')->store('lessons/files', 'public');
        }
        if($request->hasFile('gambar')){
            $data['gambar'] = $request->file('gambar')->store('lessons/gambars', 'public');
        }

        Lesson::create($data);
        return redirect()->route('admin.lessons.index')->with('succes', 'materi dibuat');
    }

    public function edit(Lesson $lesson)
    {
        $classes = Classroom::all();
        return view('admin.lessons.edit', compact('lesson', 'classes'));
    }

    public function update(Request $request, Lesson $lesson)
    {
        $data = $request->validate([
            'class_id' => 'required|exists:classes,id',
            'judul' => 'required|string|max:225',
            'konten' => 'nullable|string',
            'file' => 'nullable|file|max:10240',
            'video_url' => 'nullable|string',
            'gambar' => 'nullable|image|max:4096',
            'order' => 'nullable|integer'
        ]);

        if($request->hasFile('file')){
            $data['file'] = $request->file('file')->store('lessons/files', 'public');
        }
        if($request->hasFile('gambar')){
            $data['gambar'] = $request->file('gambar')->store('lessons/gambars', 'public');
        }

        $lesson->update($data);
        return redirect()->route('admin.lessons.index')->with('succes', 'Materi diupdate');
    }

    public function destroy(Lesson $lesson)
    {
        if($lesson->file) Storage::disk('public')->delete($lesson->file);
        if($lesson->gambar) Storage::disk('public')->delete($lesson->gambar);
        $lesson->delete();
        return back()->with('succes', 'materi dihapus');

    }
}
