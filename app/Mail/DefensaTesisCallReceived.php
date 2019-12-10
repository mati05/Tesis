<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\InfoMail;

class DefensaTesisCallReceived extends Mailable
{
    use Queueable, SerializesModels;
    public $nombre,$fecha,$horario,$sala,$proyecto,$profesor_guia;

    public function __construct($nombre,$fecha,$horario,$sala,$proyecto,$profesor_guia)
    {
        $this->nombre = $nombre;
        $this->fecha = $fecha;
        $this->horario = $horario;
        $this->sala = $sala;
        $this->proyecto = $proyecto;
        $this->profesor_guia = $profesor_guia;
    }

    public function build()
    {
        return $this->view('mails.defensa_tesis');
    }
}
