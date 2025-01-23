<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Todos;


class TodosContoller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = Todos::all();
        return response()->json($todos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_tugas' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'deadline' => 'required|date',
        ]);

        $user = \Illuminate\Support\Facades\Auth::user();

        $todo = Todos::create([
            'nama_tugas' => $request->input('nama_tugas'),
            'deskripsi' => $request->input('deskripsi'),
            'deadline' => $request->input('deadline'),
            'user_id' => $user->id
        ]);

        return response()->json([
            'message' => 'Todo created successfully',
            'todo' => $todo
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $todo = Todos::findOrFail($id);
        return response()->json($todo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'selesai' => 'required|boolean',
        ]);

        $todo = Todos::findOrFail($id);

        if (!$todo) {
            return response()->json([
                'message' => 'Todo not found'
            ], 404);
        }

        // Update kolom selesai dengan nilai boolean
        $todo->selesai = (bool) $request->input('selesai');
        $todo->save();

        return response()->json([
            'message' => 'Todo updated successfully',
            'todo' => $todo
        ]);
    }


    public function destroy(string $id)
    {
        $todo = Todos::findOrFail($id);
        $todo->delete();
        return response()->json(['message' => 'Todo deleted successfully']);
    }
}
