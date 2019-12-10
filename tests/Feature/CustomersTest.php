<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomersTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void {
        parent::setUp();

        Event::fake();
    }

    private function actingAsAdmin() {
        $this->actingAs(factory(\App\User::class)->create([
            'email' => 'mail@admin.com',
        ]));
    }
    /** @test */
    public function only_logged_in_users_can_see_the_customers_list() {
        $response = $this->get('/customers')->assertRedirect('/login');
    }

    /** @test */
    public function authenticated_user_can_see_customer_list() {
        $this->actingAs(factory(\App\User::class)->create());
        $response = $this->get('/customers')->assertOk();
    }

    /** @test */
    public function customer_can_be_added_through_form() {
        //$this->withoutExceptionHandling();
        
        $this->actingAsAdmin();

        $response = $this->post('/customers', $this->data());

        $this->assertCount(1, \App\Customer::all());
    }

    /** @test */
    public function a_name_is_required() {

        $this->actingAsAdmin();
 
        $response = $this->post('/customers', array_merge($this->data(), ['name' => '']));

        $response->assertSessionHasErrors('name');

        $this->assertCount(0, \App\Customer::all());
    }

    /** @test */
    public function a_name_has_at_least_3_characters() {
        //Event::fake();
        $this->actingAsAdmin();

        $response = $this->post('/customers', array_merge($this->data(), ['name' => 'a']));

        $response->assertSessionHasErrors('name');

        $this->assertCount(0, \App\Customer::all());
    }

    private function data() {
        return [
            'name' => 'Test User',
            'email' => 'test@test.com',
            'active' => 1,
            'company_id' => 1,
            'title' => 'cus',
        ];
    }
}
