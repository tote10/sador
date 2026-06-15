<?php

namespace Tests\Feature;

use App\Models\Applicant;
use App\Models\Message;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AdminBulkAndStatsTest extends TestCase
{
    use DatabaseTransactions;

    private function admin(): User
    {
        return User::factory()->create(['is_admin' => true]);
    }

    public function test_dashboard_renders(): void
    {
        $response = $this->actingAs($this->admin())->get(route('admin.dashboard'));
        $response->assertOk();
        $response->assertViewHas('stats');
        $this->assertArrayHasKey('applicants', $response->viewData('stats'));
    }

    public function test_mark_all_messages_read(): void
    {
        Message::create(['name' => 'A', 'phone' => '0900', 'email' => 'a@x.com', 'message' => 'hi', 'is_read' => false]);
        Message::create(['name' => 'B', 'phone' => '0900', 'email' => 'b@x.com', 'message' => 'hi', 'is_read' => false]);

        $this->actingAs($this->admin())->post(route('admin.messages.readAll'))->assertRedirect();

        $this->assertEquals(0, Message::where('is_read', false)->count());
    }

    public function test_delete_all_messages(): void
    {
        Message::create(['name' => 'A', 'phone' => '0900', 'email' => 'a@x.com', 'message' => 'hi']);
        $this->actingAs($this->admin())->delete(route('admin.messages.destroyAll'))->assertRedirect();
        $this->assertEquals(0, Message::count());
    }

    public function test_mark_all_new_applicants_reviewed(): void
    {
        Applicant::create(['full_name' => 'N1', 'phone' => '1', 'email' => 'n1@x.com', 'cv_path' => 'a.pdf', 'status' => 'new']);
        Applicant::create(['full_name' => 'N2', 'phone' => '1', 'email' => 'n2@x.com', 'cv_path' => 'b.pdf', 'status' => 'new']);

        $this->actingAs($this->admin())->post(route('admin.applicants.reviewAll'))->assertRedirect();

        $this->assertEquals(0, Applicant::where('status', 'new')->count());
        $this->assertGreaterThanOrEqual(2, Applicant::where('status', 'reviewed')->count());
    }
}
