<?php

namespace Tests\Unit;

use App\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;


class ProjectTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function it_has_path(){
        $project =factory(\App\Project::class)->make();
        $this->assertEquals('/projects/'.$project->id,$project->path());
    }
    public function it_belong_to_an_owner(){
        $project =factory(\App\Project::class)->make();
        $this->assertInstanceOf(\App\User::class,$project->owner);
    }
}
