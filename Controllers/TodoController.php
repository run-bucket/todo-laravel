<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    // Home window: Display list of To-Dos
    public function index()
    {
        $todos = Todo::latest()->get();
        return view('todos.index', compact('todos'));
    }

    // Creation window: Show the form
    public function create()
    {
        return view('todos.create');
    }

    // Store new To-Do item in DB
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
    // Toggle completion status
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