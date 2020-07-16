<?php

namespace App\Http\Controllers;
use App\Project;
use Illuminate\Http\Request;


class ProjectsController extends Controller
{
    public function index(){
        $projects= auth()->user()->projects;
        return view('projects.index',compact('projects'));
    }
    public function store(){


        //validation
        $attributes=request()->validate([
            'title'=>'required',
            'description'=>'required',
            'notes'=>'min:3'
        ]);


       $project= auth()->user()->projects()->create($attributes);



        return redirect($project->path());
    }
    public function show(\App\Project $project){
        // if(auth()->user()->isNot($project->owner)){
        //     abort(403);
        // }
        $this->authorize('update',$project);
        return view('projects.show',compact('project'));
    }
    public function create()
    {
        return view('projects.create');
    }

    public function update(Project $project){

        $this->authorize('update',$project);
        // if(auth()->user()->isNot($project->owner)){
        //     abort(403);
        // }

        $project->update(request(['notes']));

        return redirect($project->path());
    }
}
