<?php

namespace Tests\Feature;

use App\Mail\CitizenContactUsMail;
use App\Mail\GovernorContactUsAdminMail;
use App\Models\ContactUs;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ContactUsEmailTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        if (!Schema::hasTable('contact_us')) {
            Schema::create('contact_us', function ($table) {
                $table->id();
                $table->string('name');
                $table->string('email');
                $table->string('subject');
                $table->text('description');
                $table->timestamps();
            });
        }
    }

    public function test_contact_form_requires_mandatory_fields(): void
    {
        $response = $this->from('/contact')->post('/contact', []);

        $response->assertRedirect('/contact');
        $response->assertSessionHasErrors(['name', 'email', 'subject', 'description']);
    }

    public function test_contact_form_stores_record_and_triggers_both_emails(): void
    {
        Mail::fake();

        $formData = [
            'name' => 'Fatima Noor',
            'email' => 'fatima@example.com',
            'subject' => 'Research Fellowship Query',
            'description' => 'I would like to inquire about the research internship programs hosted under the Governor Initiative.',
        ];

        $response = $this->from('/contact')->post('/contact', $formData);

        $response->assertRedirect('/contact');
        $response->assertSessionHas('success', 'Your message has been sent successfully.');

        // Verify database entry
        $this->assertDatabaseHas('contact_us', [
            'name' => 'Fatima Noor',
            'email' => 'fatima@example.com',
            'subject' => 'Research Fellowship Query',
        ]);

        // Verify Citizen acknowledgment email was sent
        Mail::assertSent(CitizenContactUsMail::class, function ($mail) use ($formData) {
            return $mail->hasTo('fatima@example.com') &&
                   $mail->contact->name === $formData['name'] &&
                   $mail->contact->subject === $formData['subject'];
        });

        // Verify Governor House Team notification email was sent
        $expectedAdminEmail = config('mail.governor_email', env('GOVERNOR_EMAIL'));
        Mail::assertSent(GovernorContactUsAdminMail::class, function ($mail) use ($expectedAdminEmail, $formData) {
            return $mail->hasTo($expectedAdminEmail) &&
                   $mail->contact->email === $formData['email'] &&
                   $mail->contact->subject === $formData['subject'];
        });
    }

    public function test_citizen_and_admin_contact_mailables_render_proper_content(): void
    {
        $contact = new ContactUs([
            'name' => 'Zubair Khan',
            'email' => 'zubair@example.com',
            'subject' => 'Cultural Heritage Preservation',
            'description' => 'Proposal regarding preservation of historic archives in KP.',
        ]);
        $contact->created_at = now();

        $citizenMail = new CitizenContactUsMail($contact);
        $citizenHtml = $citizenMail->render();
        $this->assertStringContainsString('Dear <strong>Zubair Khan</strong>, thank you for contacting Governor House Khyber Pakhtunkhwa.', $citizenHtml);
        $this->assertStringContainsString('Cultural Heritage Preservation', $citizenHtml);
        $this->assertStringContainsString('Proposal regarding preservation of historic archives in KP.', $citizenHtml);

        $adminMail = new GovernorContactUsAdminMail($contact);
        $adminHtml = $adminMail->render();
        $this->assertStringContainsString('Dear Team, a new query has been received through the Contact Us form from <strong>Zubair Khan</strong> (<strong>zubair@example.com</strong>) regarding <em>Cultural Heritage Preservation</em>.', $adminHtml);
        $this->assertStringContainsString('/contact-us', $adminHtml);
    }
}

