<?php

namespace App\Mail;

use App\Models\TalkToGovernor;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class GovernorNewSubmissionMail extends Mailable
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
            subject: '[Talk to Governor] New Citizen Submission: ' . $this->submission->subject . ' [' . $this->submission->reference_number . ']',
            replyTo: [
                $this->submission->email,
            ],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.talk-to-governor-admin',
            with: [
                'submission' => $this->submission,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        $attachments = [];

        if ($this->submission->document && file_exists(public_path($this->submission->document))) {
            $attachments[] = Attachment::fromPath(public_path($this->submission->document))
                ->as(basename($this->submission->document))
                ->withMime('application/pdf');
        }

        if (!empty($this->submission->images_list)) {
            foreach ($this->submission->images_list as $imgPath) {
                if ($imgPath && file_exists(public_path($imgPath))) {
                    $attachments[] = Attachment::fromPath(public_path($imgPath))
                        ->as(basename($imgPath));
                }
            }
        }

        return $attachments;
    }
}
