<?php
  
namespace App\Mail;
   
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
  
class EmelPenyelaras extends Mailable
{
    use Queueable, SerializesModels;
  
    public $details;
   
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($aduan)
    {
        $this->aduan = $aduan;

        // print_r($aduan);
    }
   
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.emelPenyelaras')
                    ->subject('Sistem Share and Care : Aduan / Maklumbalas Baharu')
                    ->with([
                        'aduan' => $this->aduan,
                    ])
                    ->from('sistem.kdh@moh.gov.my');
    }
}