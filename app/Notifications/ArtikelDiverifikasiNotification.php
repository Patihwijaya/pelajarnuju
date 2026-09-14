<?php

namespace App\Notifications;

use App\Models\Admin;
use App\Models\Artikel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ArtikelDiverifikasiNotification extends Notification
{
    use Queueable;

    public $artikel;

    /**
     * Create a new notification instance.
     */
    public function __construct(Artikel $artikel)
    {
        $this->artikel = $artikel;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase($notifiable)
    {
        $verifier = $this->artikel->verifier;

        if ($verifier instanceof Admin && $verifier->isSuperAdmin()) {
            $role = 'Super Admin';
        } else {
            $role = 'Admin';
        }

        return [
            'title' => 'Artikel Diverifikasi',
            'message' => 'Artikel ' . $this->artikel->title . ' Anda diverifikasi oleh ' . $role,
        ];
    }
}
