<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class OefeningTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_oefening_op_id()
    {
        $response = $this->get('api/oefeningen/1');
        $response->assertStatus(200);
        $response->assertJson(['Naam'=>'Planken','Beschrijving'=>'Rugspieren trainen','Stappen'=>"1. Lig met je buik op de grond. 2. Til jezelf op met je voorarmen. 3. Blijf dit aanhouden totdat je niet meer kan.",]);
    }
   public function test_insert_oefening()
    {
        $user = User::factory()->create();
        $data = ['Naam'=>'selfmade','Beschrijving'=>'trainen','Stappen'=>'1. staan 2. liggen 3. herhaal'];
        $response = $this->actingAs($user)->json('POST','api/oefeningen', $data);
        $this->actingAs($user)->assertDatabaseHas('oefening',  $data);
        $response->assertStatus(201);
        $response->assertJsonFragment($data);
        $user->delete();
   }
 public function test_delete_oefening()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->delete('api/oefeningen/1');
        $response->assertStatus(200);
        $user->delete();
    }

}
