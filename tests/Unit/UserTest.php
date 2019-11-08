<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
  public function a_user_has_projects()
  {
     $user = factory('App\User')->create();
     
     $this->assertInstanceOf(Collection::class, $user->projects);
}
}
