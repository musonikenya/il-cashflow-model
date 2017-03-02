<?php

namespace Tyondo\Cashflow\Notifications;

use App\Cashflow;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CashflowCreated extends Notification
{
    use Queueable;

    protected $cashflow;

    /**
     * Create a new notification  instance.
     *
     * @return void
     */
    public function __construct(Cashflow $cashflow)
    {
        $this->cashflow = $cashflow;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'slack'];
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
                    ->subject('New Cashflow Loan Created')
                    ->success()
                    ->line('Hi, a new cashflow loan application has been submitted')
                    ->line('Please login to review it!')
                    ->action('View Loan', 'https://live.musonisystem.com/kenya/index.php/Loan/Loan/' . $this->cashflow->loanId)
                    ->line('Thank you for your action!');


    }

    public function toSlack($notifiable)
    {

        return (new SlackMessage)
                    ->content('New Cashflow Loan Created' . $this->cashflow->loanId);
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        //
    }
}
