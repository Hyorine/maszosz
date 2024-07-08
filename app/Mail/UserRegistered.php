<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserRegistered extends Mailable
{
       /**
     * The email subject.
     *
     * @var string
     */
    public $subject;

    /**
     * The email view.
     *
     * @var string
     */
    public $view;

    /**
     * The email address.
     *
     * @var string
     */
    public $email;
    public $token;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct($subject,$view,$email,$token)
    {
        $this->subject = $subject;
        $this->view = $view;
        $this->email = $email;
        $this->setFromAddressAndName();
        $this->to($this->email);
        $this->token = $token;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject:  $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: $this->view,
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
    private function setFromAddressAndName($fromAddress = null, $fromName = null)
    {
        $this->from($fromAddress ?? env('MAIL_FROM_ADDRESS'), $fromName ?? env('MAIL_FROM_NAME'));
    }
}
