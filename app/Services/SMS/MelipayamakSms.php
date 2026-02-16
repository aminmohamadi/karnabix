<?php

namespace App\Services\Sms;

use App\Contracts\SmsContract;
use App\Contracts\SmsNotificationContract;
use Exception;
use Melipayamak\MelipayamakApi;
use function Symfony\Component\String\b;

class MelipayamakSms extends SmsService implements SmsContract, SmsNotificationContract
{
    public function send()
    {

        $method = $this->method();
        $data   = $this->$method();

        $input_data   = $data['input_data'];
        $mobile       = $this->mobile();
        $bodyId       = $data['bodyId']; //Pattern Id

        try {
            $username  = option('MELIPAYAMAK_PANEL_USERNAME');
            $password  = option('MELIPAYAMAK_PANEL_PASSWORD');
            $text      = implode(';', $input_data);
            $api = new MelipayamakApi($username,$password);
            $smsRest = $api->sms();
            $to = $mobile;
            $smsRest->sendByBaseNumber($text, $to, $bodyId);
            $data = array('username' => $username, 'password' => $password,'text' => $text,'to' =>"$to" ,"bodyId"=>$bodyId);
            $post_data = http_build_query($data);
            $handle = curl_init('https://rest.payamak-panel.com/api/SendSMS/BaseServiceNumber');
            curl_setopt($handle, CURLOPT_HTTPHEADER, array(
                'content-type' => 'application/x-www-form-urlencoded'
            ));
            curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($handle, CURLOPT_POST, true);
            curl_setopt($handle, CURLOPT_POSTFIELDS, $post_data);
            $response = curl_exec($handle);
            $message = json_encode($response);
        } catch (Exception $e) {
            $message = $e->getMessage();
        }

        return $message;
    }

    public function verifyCode()
    {
        return [
            'bodyId'       => option('user_verify_pattern_code_melipayamak'),
            'input_data'   => [
                '0' => $this->data['code']
            ],
        ];
    }

    public function userCreated()
    {
        return [
            'bodyId'       => option('user_register_pattern_code_melipayamak'),
            'input_data'   => [
                '0'   => $this->data['fullname'],
                '1'   => $this->data['username'],
            ],
        ];
    }

    public function orderPaid()
    {
        return [
            'bodyId'       => option('order_paid_pattern_code_melipayamak'),
            'input_data'   => [
                '0' => $this->data['order_id']
            ],
        ];
    }

    public function userOrderPaid()
    {
        return [
            'bodyId'       => option('user_order_paid_pattern_code_melipayamak'),
            'input_data'   => [
                '0' => $this->data['order_id']
            ],
        ];
    }

    public function walletAmountDecreased()
    {
        return [
            'bodyId'       => option('wallet_decrease_pattern_code_melipayamak'),
            'input_data'   => [
                '0' => $this->data['amount']
            ],
        ];
    }

    public function walletAmountIncreased()
    {
        return [
            'bodyId'       => option('wallet_increase_pattern_code_melipayamak'),
            'input_data'   => [
                '0' => $this->data['amount']
            ],
        ];
    }
}
