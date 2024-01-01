<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectDashboardController extends Controller
{
    public function index(){

        $projects_list = Project::with('tasks', 'user')->get();

        return response()->json($projects_list);
    }
}
