<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class ProjectsController extends Controller
{
    public function index(){
        $projects= \App\Project::all();
        return view('projects.index',compact('projects'));
    }
    public function store(){
        //validation
        $attributes=request()->validate(['title'=>'required','description'=>'required']);
        //persist
        \App\Project::create($attributes);
        //redirect
        return redirect('/projects');
    }
    public function show(\App\Project $project){

        return view('projects.show',compact('project'));
    }
}
