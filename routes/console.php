<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('mail:test {email?}', function (?string $email = null) {
    $email = $email ?: config('mail.from.address', 'test@example.com');
    $this->info("Sending test emails to: {$email}");
    $this->line("Mailer: " . config('mail.default'));
    $this->line("Host: " . config('mail.mailers.smtp.host') . ":" . config('mail.mailers.smtp.port') . " (scheme: " . (config('mail.mailers.smtp.scheme') ?? 'default') . ")");
    $this->line("User: " . config('mail.mailers.smtp.username'));

    $dummySubmission = new \App\Models\TalkToGovernor([
        'reference_number' => 'GOV-TEST-' . strtoupper(\Illuminate\Support\Str::random(4)),
        'name' => 'Citizen (Test)',
        'email' => $email,
        'mobile_number' => '+92 300 0000000',
        'cnic' => '17301-0000000-1',
        'district' => 'Peshawar',
        'category' => 'General Suggestion / Proposal',
        'subject' => 'Test Email from Governor House KP Portal',
        'message' => 'This is a test submission email to verify that both citizen acknowledgment and governor alert templates are delivered successfully.',
    ]);

    try {
        $this->comment("1. Sending Citizen Acknowledgment email...");
        \Illuminate\Support\Facades\Mail::to($email)->send(new \App\Mail\CitizenTalkToGovernorMail($dummySubmission));
        $this->info("   Citizen email sent successfully!");

        $this->comment("2. Sending Governor / Secretariat Alert email...");
        \Illuminate\Support\Facades\Mail::to($email)->send(new \App\Mail\GovernorNewSubmissionMail($dummySubmission));
        $this->info("   Governor alert email sent successfully!");

        $this->info("SUCCESS: Both test emails sent successfully to {$email}!");
    } catch (\Throwable $e) {
        $this->error("Failed to send email: " . $e->getMessage());
        $this->line("");
        $this->warn("Troubleshooting Tips:");
        $this->line("1. If timeout on 465, try setting in .env: MAIL_PORT=587 and MAIL_SCHEME=null");
        $this->line("2. If Cloudflare is active on the root domain, try: MAIL_HOST=mail.governor.kp.gov.pk");
        $this->line("3. Ensure your real cPanel password is in .env: MAIL_PASSWORD=...");
    }
})->purpose('Test sending both Talk to Governor emails to a given address');
