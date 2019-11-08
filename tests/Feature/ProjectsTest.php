<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectsTest extends TestCase

{
    use WithFaker, RefreshDatabase;

    
    
    public function only_aunthenticated_users_can_create_project()
    {

        $attributes = factory('App\Project')->raw();

        $this->post('/projects', $attributes)->assertRedirect('/login');
    }

    public function test_a_user_can_create_a_project()
    {

        $this->withoutExceptionHandling();

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph

        ];
       $this->post('/projects', $attributes)->assertRedirect('/projects');

       $this->assertDatabaseHas('projects', $attributes);

       $this->get('/projects')->assertSee($attributes['title']);
    }

    public function a_user_can_vieew_a_project()
    {
        $this->withExceptionHandling();

        $project = factory('App\Project')->create();

        $this->get($project->path())
        ->assertSee($project->title)
        ->assertSee($project->description);
    }

    public function a_project_requires_a_title()
    {   
        $attributes = factory('App\Project')->raw(['title' => '']);


        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }


    public function a_project_requires_a_description()
    {

        $attributes = factory('App\Project')->raw(['description' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }


}
