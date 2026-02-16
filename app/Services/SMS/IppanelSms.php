<?php

namespace App\Services\Sms;

use App\Contracts\SmsContract;
use App\Contracts\SmsNotificationContract;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Log;

class IppanelSms extends SmsService implements SmsContract, SmsNotificationContract
{
    protected $settingRepository;
    public function __construct($mobile, $data, $type, $user_id)
    {
        parent::__construct($mobile, $data, $type, $user_id);
        $this->settingRepository = app(SettingRepositoryInterface::class);

    }

    public function send()
    {
        $method = $this->method();
        $data   = $this->$method();

        $username      = $this->settingRepository->getRow('smsPanelUsername');
        $password      = $this->settingRepository->getRow('smsPanelPassword');
        $from          = $this->settingRepository->getRow('smsPanelFrom');
        $to            = array($this->mobile());
//        $to            = array("09174083765");
        $pattern_code  = $data['pattern_code'];
        $input_data    = $data['input_data'];

        $url      = "https://ippanel.com/patterns/pattern?username="
            . $username . "&password=" . urlencode($password)
            . "&from=$from&to=" . json_encode($to)
            . "&input_data=" . urlencode(json_encode($input_data))
            . "&pattern_code=$pattern_code";
        $handler = curl_init($url);
        curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($handler, CURLOPT_POSTFIELDS, $input_data);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($handler);
//        dd($response);
        return $response;
    }

    public function verifyCode()
    {
        return [
            'pattern_code' => $this->settingRepository->getRow('userVerifyPattern'),
            'input_data'   => [
                'verification-code' => $this->data['code']
            ],
        ];
    }

    public function userCreated()
    {
        return [
            'pattern_code' => option('user_register_pattern_code'),
            'input_data'   => [
                'fullname' => $this->data['fullname']
            ],
        ];
    }

    public function orderPaid()
    {
        return [
            'pattern_code' => option('order_paid_pattern_code'),
            'input_data'   => [
                'order_id' => $this->data['order_id']
            ],
        ];
    }

    public function userOrderPaid()
    {
        return [
            'pattern_code' => option('user_order_paid_pattern_code'),
            'input_data'   => [
                'order_id' => $this->data['order_id']
            ],
        ];
    }

    public function walletAmountDecreased()
    {
        return [
            'pattern_code' => $this->settingRepository->getRow('userWalletDecreasedSmsPattern'),
            'input_data'   => [
                'amount' => $this->data['amount'],
                'balance' => $this->data['balance']
            ],
        ];
    }

    public function walletAmountIncreased()
    {
        return [
            'pattern_code' => $this->settingRepository->getRow('userWalletIncreasedSmsPattern'),
            'input_data'   => [
                'amount' => $this->data['amount'],
                'balance' => $this->data['balance']
            ],
        ];
    }

    public function examPaid()
    {
        return [
            'pattern_code' =>$this->settingRepository->getRow('afterExamPaidVoucherPattern'),
            'input_data'   => [
                'course' => $this->data['course'],
                'code'   => $this->settingRepository->getRow('afterExamPaidVoucherCode'),
                'percent' => $this->settingRepository->getRow('afterExamPaidVoucherPercentage')
            ],
        ];
    }

    public function examResultRejected(){
        return [
          'pattern_code' => $this->settingRepository->getRow('afterExamRejectedVoucherPattern'),
          'input_data'   => [
              'course' => $this->data['course'],
              'code'   => $this->settingRepository->getRow('afterExamRejectedVoucherPercentage'),
              'percent' => $this->settingRepository->getRow('afterExamRejectedVoucherCode')
          ]
        ];
    }

}
