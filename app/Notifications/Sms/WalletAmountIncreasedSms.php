<?php

namespace App\Notifications\Sms;

use App\Channels\SmsChannel;
use App\Models\Sms;
use App\Models\Wallet;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class WalletAmountIncreasedSms extends Notification implements ShouldQueue
{
    use Queueable;

    public $balance;
    public $amount;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($balance, $amount)
    {
        $this->balance = $balance;
        $this->amount = $amount;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [SmsChannel::class];
    }

    public function toSms($notifiable)
    {
        return [
            'mobile'       => $notifiable->phone,
            'data'         => [
                'balance'   => $this->balance,
                'amount'   => $this->amount,
            ],
            'type'         => Sms::TYPES['WALLET_AMOUNT_INCREASED'],
            'user_id'      => $notifiable->id
        ];
    }
}
