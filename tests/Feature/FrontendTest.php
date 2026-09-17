<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FrontendTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the homepage loads successfully.
     */
    public function test_home_page_loads_successfully(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Sador General Construction');
    }

    /**
     * Test that the about page loads successfully.
     */
    public function test_about_page_loads_successfully(): void
    {
        $response = $this->get('/about');
        $response->assertStatus(200);
    }

    /**
     * Test that the services page loads successfully.
     */
    public function test_services_page_loads_successfully(): void
    {
        $response = $this->get('/services');
        $response->assertStatus(200);
    }

    /**
     * Test that the projects page loads successfully.
     */
    public function test_projects_page_loads_successfully(): void
    {
        $response = $this->get('/projects');
        $response->assertStatus(200);
    }

    /**
     * Test that the vacancies page loads successfully.
     */
    public function test_vacancies_page_loads_successfully(): void
    {
        $response = $this->get('/vacancies');
        $response->assertStatus(200);
    }

    /**
     * Test that the contact page loads successfully.
     */
    public function test_contact_page_loads_successfully(): void
    {
        $response = $this->get('/contact');
        $response->assertStatus(200);
    }

    /**
     * Test contact form submission.
     */
    public function test_contact_form_submission(): void
    {
        $response = $this->post('/contact', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '1234567890',
            'service_requested' => 'General Inquiry',
            'message' => 'This is a test message.',
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        
        $this->assertDatabaseHas('messages', [
            'email' => 'john@example.com',
            'name' => 'John Doe',
            'message' => 'This is a test message.',
        ]);
    }
}
