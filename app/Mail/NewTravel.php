<?php

namespace App\Mail;

use App\Travel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewTravel extends Mailable
{
    use Queueable, SerializesModels;

    public $travel;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Travel $travel)
    {
        $this->travel = $travel;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.new-travel');
    }
}
