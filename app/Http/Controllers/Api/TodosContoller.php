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
            'user_id' => 'required|exists:users,id'
        ]);

        $todo = Todos::create([
            'nama_tugas' => $request->input('nama_tugas'),
            'deskripsi' => $request->input('deskripsi'),
            'deadline' => $request->input('deadline'),
            'user_id' => $request->input('user_id')
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
            'nama_tugas' => 'sometimes|required|string|max:255',
            'deskripsi' => 'sometimes|required|string',
            'deadline' => 'sometimes|required|date',
            'user_id' => 'sometimes|required|exists:users,id'
        ]);

        $todo = Todos::findOrFail($id);

        $todo->update($request->only(['nama_tugas', 'deskripsi', 'deadline', 'user_id']));

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
