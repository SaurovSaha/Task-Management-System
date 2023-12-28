<?php

namespace App\Http\Controllers;
use App\Models\Project;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function index(Request $request) {
        $perPage = $request->perPage ?? 6;
        $keyword = $request->keyword;

        $query = Project::query();
        // return $query;

        if ($keyword) {
            $query = $query->where('projectName', 'like', '%' . $keyword . '%');
        }

        return $query->orderByDesc('id')->paginate($perPage)->withQueryString();
    }


    public function store(Request $request){

        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'projectName' => 'required|string|max:255',
            'projectDeadline' => 'required|string',
            'status' => 'required|in:Active,Inactive'
        ]);

        $project = Project::create($validatedData);
        return response()->json($project, Response::HTTP_CREATED);
    }

    public function update(Request $request, Project $project) {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'projectName' => 'required|string|max:255',
            'projectDeadline' => 'required|string',
            'status' => 'required|in:Active,Inactive'
        ]);

        $project->update($validated);

        return response()->json($project);
    }

    public function destroy(Project $project) {
        $project->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
