<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailPaymentPlanBasic extends Mailable
{
    use Queueable, SerializesModels;

    public $info_usuario;

    public function __construct($usuario)
    {
        $this->info_usuario = $usuario;
    }

    public function build()
    {
        return $this->subject('Kaza Roza | Clube de Negócios - Seu Novo Plano')->view('email_plan_pay');
    }
}
