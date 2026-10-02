<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StockProduct extends Notification
{
    use Queueable;

    public $product;
    
    public function __construct($product)
    {
        $this->product = $product;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }


    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject(' Alerta de stock bajo')
            ->greeting('Cordial saludo, correo de su interes!')
            ->line('El producto tiene stock bajo.')
            ->line('Producto: '.$this->product->name)
            ->line('Producto: '.$this->product->amount)
            ->line('Por favor verificar el inventario')
            ->salutation('Sistema de Gestion de Inventario Tienda XYZ');


    }

    public function toArray(object $notifiable)
    {
        return [
            'product_id' => $this->product->id,
            'product_name' => $this->product->name,
            'amount' => $this->product->amount,
            'message' => 'El producto tiene stock bajo'
        ];
    }
}
