<?php

namespace Tests\Unit;

use App\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use function GuzzleHttp\Promise\task;


class ProjectTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function it_has_path(){
        $project =factory(Project::class)->make();
        $this->assertEquals('/projects/'.$project->id,$project->path());
    }
    /** @test */
    public function it_belong_to_an_owner(){
        $project =factory(\App\Project::class)->make();
        $this->assertInstanceOf(\App\User::class,$project->owner);
    }
    /** @test */
    public function it_can_add_a_task(){
        $project =factory(\App\Project::class)->create();
        $task= $project->addTask('Test task');
        $this->assertCount(1,$project->tasks);
        $this->assertTrue($project->tasks->contains($task));
    }
}
