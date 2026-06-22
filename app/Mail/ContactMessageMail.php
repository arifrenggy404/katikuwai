<?php

namespace App\Mail;

use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    public ContactMessage $messageData;

    public function __construct(ContactMessage $messageData)
    {
        $this->messageData = $messageData;
    }

    public function build()
    {
        $setting = \App\Models\Setting::first();
        $desaName = $setting ? $setting->desa_name : 'Desa Katiku Wai';
        return $this->subject('Pesan Baru dari Website ' . $desaName)
            ->view('emails.contact-message');
    }
}
