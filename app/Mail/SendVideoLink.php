<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendVideoLink extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public $other_name;
    public $isDoctor;
    public $name;
    public $details;
    public $room;
    public $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token, $other_name, $isDoctor, $name, $details, $room, $password)
    {
        $this->token = $token;
        $this->other_name = $other_name;
        $this->isDoctor = $isDoctor;
        $this->name = $name;
        $this->details = $details;
        $this->room = $room;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->token = $this->token . '/' . base64_encode($this->isDoctor);
     
        $otherType = ($this->isDoctor == 1) ? 'Patient' : 'Doctor';
        return $this->from('no-reply@downtownhospital.in')
                    ->subject($otherType .": [". $this->other_name ."] Telemedicine video conference link ")
                    ->view('mail.send-video-link');
    }
}
