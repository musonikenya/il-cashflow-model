<?php

namespace Tyondo\Cashflow\Notifications;

use Tyondo\Cashflow\Models\CashflowEdit;
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
                  ->action('View Loan', env('CASHFLOW_LOAN_URL') . $this->cashflow->loanId);
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
