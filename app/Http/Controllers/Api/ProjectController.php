<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(){ //stessi nomi con le crud
        $projects = Project::with(["type", "technologies"])->paginate(5); //Usiamo sempre lo STESSO MODEL! :D
        
        return response()->json($projects); //ritorno l'array che mi ritrovo con Project::with qui sopra sotto forma di json.
    }
}
