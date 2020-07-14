<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;


class ProjectTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function it_has_path(){
        $project =factory('App\Project')->create();
        $this->assertEquals('/project/'.$project->id,$project->path());
    }
}
