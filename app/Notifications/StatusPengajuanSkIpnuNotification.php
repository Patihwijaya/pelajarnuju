<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;

class StatusPengajuanSkIpnuNotification extends Notification
{
    use Queueable;

    public $status;
    public $catatan;

    /**
     * Create a new notification instance.
     */
    public function __construct($status, $catatan)
    {
        $this->status = $status;
        $this->catatan = $catatan;
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
     * Get the mail representation of the notification.
     */
    public function toDatabase($notifiable)
    {
        return [
            'title' => 'status Pengajuan SK',
            'message' => 'Pengajuan Kamu Sekarang: ' . $this->status,
            'catatan' => $this->catatan,
        ];
    }

    // /**
    //  * Get the array representation of the notification.
    //  *
    //  * @return array<string, mixed>
    //  */
    // public function toArray(object $notifiable): array
    // {
    //     return [
    //         //
    //     ];
    // }
}
