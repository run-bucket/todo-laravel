<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List App</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 min-h-screen p-6 md:p-12">
    <div class="max-w-3xl mx-auto bg-white/80 backdrop-blur-md p-8 rounded-3xl shadow-xl border border-white/60">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-extrabold text-slate-700 tracking-tight">My To-Do List ✨</h1>
            <a href="{{ route('todos.create') }}" class="bg-purple-200 hover:bg-purple-300 text-purple-950 font-semibold py-2.5 px-5 rounded-2xl shadow-sm transition">
                + Create New To-Do
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-teal-50 border border-teal-200 text-teal-800 rounded-2xl text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

        @if($todos->isEmpty())
            <p class="text-slate-400 text-center py-8 font-medium">No tasks found. Click above to create your first one! 🌸</p>
        @else
            <div class="space-y-4">
                @foreach($todos as $todo)
                    <div class="p-5 rounded-2xl flex justify-between items-start transition border {{ $todo->is_completed ? 'bg-slate-50/70 border-slate-100' : 'bg-white border-purple-100/80 shadow-sm' }}">
                        <div>
                            <h3 class="text-lg font-bold {{ $todo->is_completed ? 'line-through text-slate-400' : 'text-slate-700' }}">
                                {{ $todo->title }}
                            </h3>
                            @if($todo->description)
                                <p class="text-slate-500 text-sm mt-1 font-normal">{{ $todo->description }}</p>
                            @endif
                        </div>

                        <div class="text-right flex flex-col items-end gap-2">
                            <div class="flex items-center gap-2">
                                <!-- Status Toggle -->
                                <form action="{{ route('todos.toggle', $todo) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    
                                    @if($todo->is_completed)
                                        <button type="submit" title="Click to mark as pending" class="bg-teal-100 text-teal-800 hover:bg-teal-200 text-xs font-semibold px-3 py-1.5 rounded-xl transition cursor-pointer">
                                            ✓ Completed
                                        </button>
                                    @else
                                        <button type="submit" title="Click to mark as completed" class="bg-rose-100 text-rose-700 hover:bg-rose-200 text-xs font-semibold px-3 py-1.5 rounded-xl transition cursor-pointer">
                                            Mark Complete
                                        </button>
                                    @endif
                                </form>

                                <!-- Delete Action -->
                                <form action="{{ route('todos.destroy', $todo) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Delete Task" class="bg-red-100 text-red-600 hover:bg-red-200 text-xs font-semibold px-2.5 py-1.5 rounded-xl transition cursor-pointer">
                                        🗑️
                                    </button>
                                </form>
                            </div>

                            @if($todo->is_completed)
                                <p class="text-[11px] text-slate-400 font-medium">Done: {{ $todo->completed_at->format('Y-m-d H:i') }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>