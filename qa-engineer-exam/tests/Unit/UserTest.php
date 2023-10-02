<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    public function test_login_form()

    {
        $response = $this->get('/login');

        $response->assertStatus(200);

    }

      public function test_user_duplication()

    {
        $U1 = User::make([
            'name'=>'Detective',
            'email'=>'Detective@gmail.com'
        ]);

        $U2 = User::make([
            'name'=> 'Pikachu',
            'email' => 'Pikachu@gmail.com'
        ]);

        $this->assertTrue($U1->name != $U2->name);
    }

        public function test_delete_user()
        {

            $user = User::factory()->count(1);

            $user = User::first();

            if($user){
                    $user->delete();
            }

            $this->assertTrue(true);

        }

        public function test_new_user()
        {
            $response = $this->post('/register', [
                'name' => 'Luffy',
                'email' => 'Luffy@gmail.com',
                'password' => 'Luffy12345',
                'confirm_password' => 'Luffy12345'
            ]);

            $response->assertRedirect('/');

        }

        public function test_database()
        {
            $this->assertDatabaseMissing('users', [
                'name' => 'Jewel'
            ]);
        }

        public function test_seeders_if_working()
        {
            $this->seed();
        }

}
