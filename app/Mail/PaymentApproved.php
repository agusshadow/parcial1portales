<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class PaymentApproved extends Mailable
{
    use Queueable, SerializesModels;

    public string $codigo;

    /**
     * Create a new message instance.
     */
    public function __construct(public Order $order)
    {
        $this->codigo = $this->generarCodigoJuego();
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pago aprobado',
            from: new Address('no-reply@digitalgames.com', 'Administrador')
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            html: 'emails.payment-approved',
            text: 'emails.payment-approved-text',
            with: [
                'order' => $this->order,
                'codigo' => $this->codigo,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    /**
     * Genera un código ficticio estilo RGERG-4343-FRF
     */
    private function generarCodigoJuego(): string
    {
        $parte1 = strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 5));
        $parte2 = str_pad(strval(rand(0, 9999)), 4, '0', STR_PAD_LEFT);
        $parte3 = strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3));

        return $parte1 . '-' . $parte2 . '-' . $parte3;
    }
}