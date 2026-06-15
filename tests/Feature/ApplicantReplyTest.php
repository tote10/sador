<?php

namespace Tests\Feature;

use App\Mail\AdminReply;
use App\Models\Applicant;
use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ApplicantReplyTest extends TestCase
{
    use DatabaseTransactions;

    public function test_replying_sends_email_and_updates_status(): void
    {
        Mail::fake();

        $admin = User::factory()->create(['is_admin' => true]);
        $vacancy = Vacancy::create([
            'title' => 'Site Engineer', 'type' => 'Full-Time', 'location' => 'Addis Ababa',
            'experience' => '3 years', 'description' => 'desc', 'is_open' => true,
        ]);
        $applicant = Applicant::create([
            'vacancy_id' => $vacancy->id, 'full_name' => 'Alex Applicant',
            'phone' => '0900', 'email' => 'alex@example.com', 'cv_path' => 'x.pdf', 'status' => 'new',
        ]);

        $response = $this->actingAs($admin)->post(route('admin.applicants.reply', $applicant), [
            'subject' => 'Interview Invitation — Site Engineer',
            'body' => "We'd like to invite you to an interview.",
            'status' => 'interviewed',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        // Status was updated...
        $this->assertEquals('interviewed', $applicant->fresh()->status);

        // ...and the email went to the applicant with the admin's content.
        Mail::assertSent(AdminReply::class, function ($mail) {
            return $mail->hasTo('alex@example.com')
                && $mail->subjectLine === 'Interview Invitation — Site Engineer';
        });
    }
}
