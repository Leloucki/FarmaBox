<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JustTesting extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('contatofarmabox10@gmail.com')
		        ->to('lucaspmorais01@gmail.com')
		        ->cc('feliperaniere.g2609@gmail.com')
                   ->subject('Imposto é roubo!')
                   ->markdown('costumer.mails.exmpl')
                   ->with([
                     'name' => 'Lucas',
                     'link' => 'https://www.youtube.com/watch?v=PpDBAGqQwoA&t'
                   ]);
    }
}
