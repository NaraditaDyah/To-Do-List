<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Carbon\Carbon;   

class TodoController extends Controller
{
    // 1. Menampilkan semua tugas tanpa memandang user
    public function index()
    {
        $todos = Todo::orderBy('deadline', 'asc')->get();
        $pageTitle = "All Tasks"; // Untuk penanda judul halaman
        return view('todo', compact('todos', 'pageTitle'));
    }

    public function today()
    {
        // Mengambil tanggal hari ini dengan format YYYY-MM-DD
        $todayDate = Carbon::today()->toDateString();

        // Filter tugas yang deadlinenya hari ini
        $todos = Todo::whereDate('deadline', $todayDate)->orderBy('created_at', 'desc')->get();
        $pageTitle = "Today's Task";

        return view('todo', compact('todos', 'pageTitle'));
    }

    // 2. Menyimpan tugas baru tanpa memasukkan user_id
    public function store(Request $request)
    {
        $request->validate([
            'task_name' => 'required|string|max:255',
            'deadline' => 'required|date',
        ]);

        Todo::create([
            'task_name' => $request->task_name,
            'deadline' => $request->deadline,
        ]);

        return redirect()->back()->with('success', 'Tugas berhasil ditambahkan!');
    }

    // 3. Mengubah status checklist via AJAX
    public function check($id)
    {
        $todo = Todo::findOrFail($id);
        $todo->update(['is_completed' => !$todo->is_completed]);

        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->back();
    }

    // 4. Memperbarui data tugas (Tanpa filter user_id)
    public function update(Request $request, $id)
    {
        $request->validate([
            'task_name' => 'required|string|max:255',
            'deadline' => 'required|date',
        ]);

        $todo = Todo::findOrFail($id);
        $todo->update($request->all());

        return redirect()->back()->with('success', 'Tugas berhasil diperbarui!');
    }

    // 5. Menghapus tugas (Tanpa filter user_id)
    public function destroy($id)
    {
        $todo = Todo::findOrFail($id);
        $todo->delete();

        return redirect()->back()->with('success', 'Tugas berhasil dihapus!');
    }
}