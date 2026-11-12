<?php

namespace App\Mail;

use App\Models\TalkToGovernor;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CitizenTalkToGovernorMail extends Mailable
{
    use Queueable, SerializesModels;

    public TalkToGovernor $submission;

    /**
     * Create a new message instance.
     */
    public function __construct(TalkToGovernor $submission)
    {
        $this->submission = $submission;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Acknowledgment: Your Submission to the Governor Secretariat [' . $this->submission->reference_number . ']',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.talk-to-governor-citizen',
            with: [
                'submission' => $this->submission,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
