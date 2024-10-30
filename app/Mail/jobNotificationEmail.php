<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class jobNotificationEmail extends Mailable
{
    use Queueable, SerializesModels;
     public $maildata;
    /**
     * Create a new message instance.
     */
    public function __construct($maildata)
    {
        $this->maildata = $maildata;
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        $email = $this->subject('Job Application Notification')
                      ->view('email.jobEmail')
                      ->with('maildata', $this->maildata);
    
        // Attach the resume from the 'public' disk if it exists
        if (!empty($this->maildata['resume'])) {
            $email->attachFromStorageDisk('public', $this->maildata['resume'], 'resume.pdf', [
                'mime' => 'application/pdf'
            ]);
        }
    
        return $email;
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
