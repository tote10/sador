<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Project;
use App\Models\Service;
use App\Models\Vacancy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create an admin user for testing
        $this->admin = User::factory()->create([
            'is_admin' => true,
        ]);
    }

    public function test_guests_cannot_access_admin_dashboard(): void
    {
        $response = $this->get('/admin');
        $response->assertRedirect('/login');
    }

    public function test_regular_users_cannot_access_admin_dashboard(): void
    {
        $user = User::factory()->create(['is_admin' => false]);
        
        $response = $this->actingAs($user)->get('/admin');
        $response->assertStatus(403); // Or whatever logic you use for non-admins, assuming a 403 Forbidden
    }

    public function test_admin_can_access_dashboard(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin');
        $response->assertStatus(200);
    }

    public function test_admin_can_view_projects_list(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/projects');
        $response->assertStatus(200);
    }

    public function test_admin_can_create_project(): void
    {
        \Illuminate\Support\Facades\Storage::fake('public');
        
        $projectData = [
            'title' => 'Test Project',
            'category' => 'commercial',
            'location' => 'Addis Ababa',
            'year' => '2026',
            'budget' => '1000000',
            'duration' => '6 Months',
            'client_name' => 'Test Client',
            'status' => 'Completed',
            'description' => 'A test project description.',
            'is_published' => 1,
            'is_featured' => 1,
            'cover_image' => \Illuminate\Http\Testing\File::create('cover.jpg', 10, 'image/jpeg'),
        ];

        $response = $this->actingAs($this->admin)->post('/admin/projects', $projectData);
        
        $response->assertRedirect();
        $this->assertDatabaseHas('projects', [
            'title' => 'Test Project',
        ]);
    }

    public function test_admin_can_view_services_list(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/services');
        $response->assertStatus(200);
    }

    public function test_admin_can_create_service(): void
    {
        $serviceData = [
            'title' => 'Test Service',
            'short_description' => 'Short desc',
            'full_description' => 'Full test description',
            'is_published' => 1,
        ];

        $response = $this->actingAs($this->admin)->post('/admin/services', $serviceData);
        
        $response->assertRedirect();
        $this->assertDatabaseHas('services', [
            'title' => 'Test Service',
        ]);
    }

    public function test_admin_can_view_vacancies_list(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/vacancies');
        $response->assertStatus(200);
    }
}
