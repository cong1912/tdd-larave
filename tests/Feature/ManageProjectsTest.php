<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageProjectsTest extends TestCase
{
    use WithFaker,RefreshDatabase;

    /** @test */
    public function guest_can_not_manage_projects(){

        $project =factory('App\Project')->create();

        $this->get('projects')->assertRedirect('login');
        $this->get('projects')->assertRedirect('login');
        $this->get($project->path())->assertRedirect('login');
        $this->post('/projects',$project->toArray())->assertRedirect('login');


    }


    /** @test */
    public function a_user_can_create_a_project(){
        $this->withExceptionHandling();
        $this->signIn();
      //  $this->actingAs(factory('App\User')->create());
        $this->get('projects/create')->assertStatus(200);

        $attributes=[
            'title'=>$this->faker->sentence,
            'description'=>$this->faker->paragraph
        ];
        $this->post('/projects',$attributes)->assertRedirect('/projects');
        $this->assertDatabaseHas('projects',$attributes);
        $this->get('/projects')->assertSee($attributes['title']);
    }
    /** @test */
    public function a_project_requires_a_title(){
        $this->signIn();
        $attributes =factory('App\Project')->raw(['title'=>'']);
        $this->post('/projects',$attributes)->assertSessionHasErrors('title');
    }
    /** @test */
    public function a_project_requires_a_description(){
        $this->signIn();
        $attributes =factory('App\Project')->raw(['description'=>'']);
        $this->post('/projects',$attributes)->assertSessionHasErrors('description');
    }
    /** @test */
    public function a_user_can_view_their_project(){
        $this->signIn();

        $this->withoutExceptionHandling();
        $project=factory('App\Project')->create(['owner_id'=>auth()->id()]);
        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description);

    }
    /** @test */
    public function an_authentucated_user_cannot_view_the_projects_of_others(){
        $this->be(factory('App\User')->create());

        //$this->withoutExceptionHandling();
        $project=factory('App\Project')->create();
        $this->get($project->path())->assertStatus(403);
    }

}
