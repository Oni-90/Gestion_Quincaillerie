<?php

    namespace App\Notifications\Product;

    use Illuminate\Bus\Queueable;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Illuminate\Notifications\Messages\MailMessage;
    use Illuminate\Notifications\Notification;

    class ProductAlertNotification extends Notification implements ShouldQueue
    {
        use Queueable;

        private $product;

        /**
         * Create a new notification instance.
         */
        public function __construct($product)
        {
            $this->product = $product;
        }

        /**
         * Get the notification's delivery channels.
         *
         * @return array<int, string>
         */
        public function via(object $notifiable): array
        {
            return ['mail','database'];
        }

        /**
         * Get the mail representation of the notification.
         */
        public function toMail(object $notifiable): MailMessage
        {
            return (new MailMessage)
                        ->subject('Le seuil minimal du produit atteint')
                        ->line('Le produit {$this->product->name} a atteint ou depassé son seuil minimal de quantité en stock.')
                        ->line('Quantité actuelle : {$this->product->quantity}')
                        ->action('Voir plus', url('/api/products'.$this->product->id))
                        ->line('Veuillez vérifier et approvisionner le stock si possible.');
        }

        /**
         * Get the array representation of the notification.
         *
         * @return array<string, mixed>
         */
        public function toArray(object $notifiable): array
        {
            return [
                'product_id' => $this->product->id,
                'name' => $this->product->name,
                'quantity' =>$this->product->quantity,
                // ... $this->data,
            ];
        }
    }
