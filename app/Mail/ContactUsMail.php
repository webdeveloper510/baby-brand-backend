<?php
  
namespace App\Mail;
  
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
  
class ContactUsMail extends Mailable
{
    use Queueable, SerializesModels;
  
    public $first_name;
    public $last_name;
    public $email;
    public $phone_number;
    public $company_name;
    public $subject;
  
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($first_name, $last_name, $email, $phone_number, $company_name, $subject)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->phone_number = $phone_number;
        $this->company_name = $company_name;
        $this->subject = $subject;
    }
  
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.contactUs')
                    ->subject($this->subject)
                    ->with([
                        'first_name' => $this->first_name,
                        'last_name' => $this->last_name,
                        'email' => $this->email,
                        'phone_number' => $this->phone_number,
                        'company_name' => $this->company_name,
                        'subject' => $this->subject,
                    ]);
    }
}