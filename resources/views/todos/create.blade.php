<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create To-Do</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 min-h-screen p-6 md:p-12">
    <div class="max-w-lg mx-auto bg-white/80 backdrop-blur-md p-8 rounded-3xl shadow-xl border border-white/60">
        <h1 class="text-2xl font-extrabold text-slate-700 mb-6">Create New Task 📝</h1>

        <form action="{{ route('todos.store') }}" method="POST">
            @csrf
            
            <div class="mb-5">
                <label class="block text-slate-600 font-medium mb-2 text-sm" for="title">Title *</label>
                <input type="text" name="title" id="title" required class="w-full bg-white/80 border border-purple-100 rounded-2xl px-4 py-2.5 text-slate-700 focus:outline-none focus:ring-2 focus:ring-purple-300 transition">
            </div>

            <div class="mb-5">
                <label class="block text-slate-600 font-medium mb-2 text-sm" for="description">Description</label>
                <textarea name="description" id="description" rows="3" class="w-full bg-white/80 border border-purple-100 rounded-2xl px-4 py-2.5 text-slate-700 focus:outline-none focus:ring-2 focus:ring-purple-300 transition"></textarea>
            </div>

            <div class="mb-6 flex items-center">
                <input type="checkbox" name="is_completed" id="is_completed" value="1" class="h-4 w-4 text-purple-400 rounded-md focus:ring-purple-300">
                <label for="is_completed" class="ml-2.5 text-slate-600 font-medium text-sm">Mark as Completed</label>
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('todos.index') }}" class="text-slate-400 hover:text-slate-600 text-sm font-medium transition">Cancel</a>
                <button type="submit" class="bg-purple-200 hover:bg-purple-300 text-purple-950 font-semibold py-2.5 px-6 rounded-2xl shadow-sm transition">
                    Save To-Do
                </button>
            </div>
        </form>
    </div>
</body>
</html>