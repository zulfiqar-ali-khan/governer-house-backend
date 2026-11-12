<?php

namespace Tests\Feature;

use App\Mail\CitizenTalkToGovernorMail;
use App\Mail\GovernorNewSubmissionMail;
use App\Models\TalkToGovernor;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class TalkToGovernorValidationTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        if (!Schema::hasTable('talk_to_governors')) {
            Schema::create('talk_to_governors', function ($table) {
                $table->id();
                $table->string('reference_number')->nullable()->unique();
                $table->string('name');
                $table->string('email');
                $table->string('mobile_number')->nullable();
                $table->string('cnic')->nullable();
                $table->string('district')->nullable();
                $table->string('category')->nullable();
                $table->string('subject')->nullable();
                $table->text('message');
                $table->string('document')->nullable();
                $table->text('images')->nullable();
                $table->timestamps();
            });
        }
    }

    public function test_form_requires_recaptcha(): void
    {
        $response = $this->from('/')->post('/talk-to-governor', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'mobile_number' => '+92 300 1234567',
            'district' => 'Peshawar',
            'category' => 'General Suggestion / Proposal',
            'subject' => 'Test Subject',
            'message' => 'Test Message Content',
            'consent' => '1',
            // 'g-recaptcha-response' omitted
        ]);

        $response->assertRedirect('/');
        $response->assertSessionHasErrors(['g-recaptcha-response']);
        $this->assertEquals(
            'Please complete the reCAPTCHA verification.',
            session('errors')->first('g-recaptcha-response')
        );
    }

    public function test_form_fails_when_recaptcha_verification_fails(): void
    {
        Http::fake([
            'https://www.google.com/recaptcha/api/siteverify' => Http::response(['success' => false], 200),
        ]);

        $response = $this->from('/')->post('/talk-to-governor', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'mobile_number' => '+92 300 1234567',
            'district' => 'Peshawar',
            'category' => 'General Suggestion / Proposal',
            'subject' => 'Test Subject',
            'message' => 'Test Message Content',
            'consent' => '1',
            'g-recaptcha-response' => 'invalid-token',
        ]);

        $response->assertRedirect('/');
        $response->assertSessionHasErrors(['g-recaptcha-response']);
        $this->assertStringContainsString(
            'reCAPTCHA verification failed',
            session('errors')->first('g-recaptcha-response')
        );
    }

    public function test_citizen_email_renders_properly(): void
    {
        $submission = new TalkToGovernor([
            'reference_number' => 'GOV-261112-TEST',
            'name' => 'Ahmad Khan',
            'email' => 'ahmad@example.com',
            'mobile_number' => '+92 300 1234567',
            'cnic' => '17301-1234567-1',
            'district' => 'Peshawar',
            'category' => 'Youth Affairs & Sports',
            'subject' => 'Youth Sports Facilities',
            'message' => 'Please provide more sports grounds for youth.',
        ]);

        $mailable = new CitizenTalkToGovernorMail($submission);
        $mailable->assertHasSubject('Acknowledgment: Your Submission to the Governor Secretariat [GOV-261112-TEST]');
        $rendered = $mailable->render();

        $this->assertStringContainsString('GOV-261112-TEST', $rendered);
        $this->assertStringContainsString('Ahmad Khan', $rendered);
        $this->assertStringContainsString('Youth Sports Facilities', $rendered);
    }

    public function test_governor_admin_email_renders_properly(): void
    {
        $submission = new TalkToGovernor([
            'reference_number' => 'GOV-261112-TEST',
            'name' => 'Ahmad Khan',
            'email' => 'ahmad@example.com',
            'mobile_number' => '+92 300 1234567',
            'cnic' => '17301-1234567-1',
            'district' => 'Peshawar',
            'category' => 'Youth Affairs & Sports',
            'subject' => 'Youth Sports Facilities',
            'message' => 'Please provide more sports grounds for youth.',
        ]);

        $mailable = new GovernorNewSubmissionMail($submission);
        $mailable->assertHasSubject('[Talk to Governor] New Citizen Submission: Youth Sports Facilities [GOV-261112-TEST]');
        $this->assertTrue($mailable->hasReplyTo('ahmad@example.com'));
        $rendered = $mailable->render();

        $this->assertStringContainsString('GOV-261112-TEST', $rendered);
        $this->assertStringContainsString('Ahmad Khan', $rendered);
        $this->assertStringContainsString('ahmad@example.com', $rendered);
    }

    public function test_successful_form_submission_triggers_both_emails(): void
    {
        Mail::fake();
        Http::fake([
            'https://www.google.com/recaptcha/api/siteverify' => Http::response(['success' => true], 200),
        ]);

        $response = $this->from('/')->post('/talk-to-governor', [
            'name' => 'Ahmad Khan',
            'email' => 'ahmad@example.com',
            'mobile_number' => '+92 300 1234567',
            'cnic' => '17301-1234567-1',
            'district' => 'Peshawar',
            'category' => 'Education & Higher Education',
            'subject' => 'University Scholarships',
            'message' => 'Need scholarships for underprivileged students.',
            'consent' => '1',
            'g-recaptcha-response' => 'valid-test-token',
        ]);

        $response->assertRedirect('/');
        $response->assertSessionHas('success');
        $response->assertSessionHas('reference_number');

        // 1. Assert Citizen Email was sent
        Mail::assertSent(CitizenTalkToGovernorMail::class, function ($mail) {
            $expectedCitizen = config('mail.citizen_mail_override') ?: 'ahmad@example.com';
            return $mail->hasTo($expectedCitizen) &&
                   $mail->submission->name === 'Ahmad Khan';
        });

        // 2. Assert Governor / Secretariat Email was sent
        Mail::assertSent(GovernorNewSubmissionMail::class, function ($mail) {
            $governorEmail = config('mail.governor_email');
            return $mail->hasTo($governorEmail) &&
                   $mail->submission->name === 'Ahmad Khan';
        });
    }
}
