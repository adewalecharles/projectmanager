<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTest extends TestCase
{

    use RefreshDatabase;

public function it_has_a_patch()
{
  $project = factory('App\Project')->crrate();
  
  $this->assertEquals('/projects/' . $project->id, $project->path());
}


}
