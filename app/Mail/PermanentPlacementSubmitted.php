<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\PermanentPlacement;

class PermanentPlacementSubmitted extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $placement;
    public $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(PermanentPlacement $placement, $subject, $message = '')
    {
        $this->placement = $placement;
        $this->subject = $subject;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)
                    ->markdown('emails.permanent_placement.submitted');
    }
}
