<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::latest()->get();
        return view('todos.index', compact('todos'));
    }

    public function create()
    {
        return view('todos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $isCompleted = $request->has('is_completed');

        Todo::create([
            'title' => $request->title,
            'description' => $request->description,
            'is_completed' => $isCompleted,
            'completed_at' => $isCompleted ? now() : null,
        ]);

        return redirect()->route('todos.index')->with('success', 'To-Do item created successfully!');
    }

    public function toggle(Todo $todo)
    {
        $todo->is_completed = !$todo->is_completed;
        $todo->completed_at = $todo->is_completed ? now() : null;
        $todo->save();

        return redirect()->route('todos.index')->with('success', 'To-Do status updated!');
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();

        return redirect()->route('todos.index')->with('success', 'To-Do item deleted successfully!');
    }
}