<?php

namespace Tests\Unit;

use App\Project;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Setup\ProjectFactory;
use Tests\TestCase;

class ActivityTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function it_has_a_user()
    {
        $user= $this->signIn();
        $project= \Facades\Tests\Setup\ProjectFactory::ownedBy($user)->create();
        $this->assertEquals($user->id,$project->activity->first()->user->id);
    }
}
