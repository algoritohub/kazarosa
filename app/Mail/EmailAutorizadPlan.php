<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailAutorizadPlan extends Mailable
{
    use Queueable, SerializesModels;

    public $info_plan;

    public function __construct($plan)
    {
        $this->info_plan = $plan;
    }

    public function build()
    {
        return $this->subject('Kaza Roza | Clube de Negócios - Autorizado')->view('email_plan_autorizado');
    }
}
