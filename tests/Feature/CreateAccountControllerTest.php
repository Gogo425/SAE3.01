<?php

namespace Tests\Feature;

use App\Models\Persons;
use App\Models\User;
use App\Models\Initiators;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class CreateAccountControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_a_new_user_successfully()
    {

        dump(DB::table('persons')->get());
        
        $userData = [
            'name' => 'John',
            'surname' => 'Doe',
            'email' => 'john.doe@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'licence_number' => 'A-01-123456',
            'medical_certificate_date' => '2023-01-01',
            'birth_date' => '1990-01-01',
            'adress' => '123 Main St',
            'level' => ['ni3'],
            'roles' => ['Initiator'],
        ];

       
        $response = $this->post(route('account.create'), $userData);

        
        $this->assertDatabaseHas('persons', [
            'email' => 'john.doe@example.com',
            'name' => 'John',
            'surname' => 'Doe',
        ]);
        /*

        
        $this->assertDatabaseHas('users', [
            'email' => 'john.doe@example.com',
            'name' => 'John',
        ]);

       
        $this->assertDatabaseHas('initiators', [
            'id_per' => Persons::count(),  // Assurez-vous que cette condition est correcte selon la logique de votre DB
            'id_level' => 2,  // Niveau 'ni1'
        ]);

       
        $response->assertSessionHas('success', 'Utilisateur enregistré avec succès !');
         */
    }

   
}
