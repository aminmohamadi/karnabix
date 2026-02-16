<?php

namespace App\Notifications\Sms;

use App\Channels\SmsChannel;
use App\Models\Course;
use App\Models\OneTimeCode;
use App\Models\Sms;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ExamRejectedSMS extends Notification
{
    use Queueable;

    protected $course;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($course)
    {
        $this->course = $course;
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
            'mobile'  => $notifiable->phone,
            'data'    => [
                'course' => $this->course,
            ],
            'type'    => Sms::TYPES['EXAM_RESULT_REJECTED'],
            'user_id' => $notifiable->id
        ];
    }
}
