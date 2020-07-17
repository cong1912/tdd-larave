<?php

namespace App\Http\Controllers;
use App\Http\Requests\UpdateProjectRequest;
use App\Project;
use Illuminate\Http\Request;


class ProjectsController extends Controller
{
    public function index(){
        $projects= auth()->user()->projects;
        return view('projects.index',compact('projects'));
    }

    public function store(){


        $project= auth()->user()->projects()->create($this->validateRequest());
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

    public function update(UpdateProjectRequest $request,Project $project){
        $project->update($request->validated());
        return redirect($project->path());
    }
    public function edit(Project $project){
        return view('projects.edit',compact('project'));
    }

    /**
     * @return array
     */
    protected function validateRequest()
    {
        return request()->validate([
            'title' => 'sometimes|required',
            'description' => 'sometimes|required',
            'notes' => 'nullable'
        ]);

    }
}
