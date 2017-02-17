<?php

namespace App\Jobs;

use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $proxy;
    protected $template;
    protected $email;
    protected $subject;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($proxy,$template,$email,$subject)
    {
        $this->proxy = $proxy;
        $this->template = $template;
        $this->email = $email;
        $this->subject = $subject;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mail)
    {
        $mail->send($this->template,['bundle' => $this->proxy],function($send) {
           $send->to($this->email)->subject($this->subject);
        });
    }
}
