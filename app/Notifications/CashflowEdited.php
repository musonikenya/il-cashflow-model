<?php

namespace App\Notifications;

use App\CashflowEdit;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CashflowEdited extends Notification
{
    use Queueable;
    protected $cashflowEdited;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(CashflowEdit $cashflowEdited)
    {
        $this->cashflowEdited = $cashflowEdited;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
      return (new MailMessage)
                  ->subject('Cashflow Loan Edited')
                  ->success()
                  ->line('Hi, created cashflow loan application has been edited')
                  ->action('View Loan', 'https://demo.musonisystem.com/kenya/index.php/Loan/Loan/' . $this->cashflow->loanId)
                  ->line('Thank you for your action!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}