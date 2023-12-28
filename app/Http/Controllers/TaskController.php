<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TaskController extends Controller
{

    public function index(Request $request) {
        $perPage = $request->perPage ?? 6;
        $keyword = $request->keyword;

        $query = Task::query();
        // return $query;

        if ($keyword) {
            $query = $query->where('taskName', 'like', '%' . $keyword . '%');
        }

        return $query->orderByDesc('id')->paginate($perPage)->withQueryString();
    }

    public function store(Request $request){

        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'project_id' => 'required|exists:projects,id',
            'taskName' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:Active,Inactive'
        ]);

        $task = Task::create($validatedData);
        return response()->json($task, Response::HTTP_CREATED);
    }

    public function update(Request $request, Task $task) {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'project_id' => 'required|exists:projects,id',
            'taskName' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:Active,Inactive'
        ]);

        $task->update($validated);

        return response()->json($task);
    }

    public function destroy(Task $task) {
        $task->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
