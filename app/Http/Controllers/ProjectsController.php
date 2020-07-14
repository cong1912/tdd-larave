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
        $attributes=request()->validate([
            'title'=>'required',
            'description'=>'required',

        ]);



        auth()->user()->projects()->create($attributes);



        return redirect('/projects');
    }
    public function show(\App\Project $project){

        return view('projects.show',compact('project'));
    }
}
