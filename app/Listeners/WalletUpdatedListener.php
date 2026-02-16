<?php

namespace App\Listeners;

use App\Models\Wallet;
use App\Notifications\Sms\WalletAmountDecreasedSms;
use App\Notifications\Sms\WalletAmountIncreasedSms;
use App\Repositories\Classes\SettingRepository;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Bavix\Wallet\Internal\Events\BalanceUpdatedEventInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class WalletUpdatedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(BalanceUpdatedEventInterface $event): void
    {

        $wallet = Wallet::find($event->getWalletId());

        $user = $wallet->holder;
        $userRepository = app(UserRepositoryInterface::class);
        $settingRepository = app(SettingRepository::class);
        $userWallet = $userRepository->walletTransactions($user)->last();
        if ($userWallet->type == "deposit") {
            if ($settingRepository->getRow('userWalletBalanceIncreasedSmsEnabled')){
                $user->notifyNow(new WalletAmountIncreasedSms($event->getBalance(), $userWallet->amount));
            }
        }elseif ($userWallet->type == "withdraw") {
          if ($settingRepository->getRow('userWalletBalanceDecreasedSmsEnabled')){
              $user->notifyNow(new WalletAmountDecreasedSms($event->getBalance(), $userWallet->amount));
          }
        }

    }
}
