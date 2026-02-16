<?php

namespace App\Http\Controllers\Site\Includes\Site;

use App\Models\Transcript;
use App\Repositories\Classes\CertificateRepository;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Http\Controllers\BaseComponent;
use function PHPUnit\Framework\isNull;

class Footer extends BaseComponent
{
    public $cert, $about_footer, $instagram, $telegram, $youtube, $twitter,  $title , $footerText , $address , $email , $autographs , $tel , $search , $copyRight , $users_can_send_teacher_request;

    public function __construct()
    {
        $this->certificateRepository = app(CertificateRepository::class);
    }

    public function mount(SettingRepositoryInterface $settingRepository)
    {
        $this->title = $settingRepository->getRow('title');
        $this->footerText = $settingRepository->getRow('footerText');
        $this->address = $settingRepository->getRow('address');
        $this->email = $settingRepository->getRow('email');
        $this->tel = $settingRepository->getRow('tel');
        $this->copyRight = $settingRepository->getRow('copyRight');
        $this->instagram = $settingRepository->getRow('instagram');
        $this->telegram = $settingRepository->getRow('telegram');
        $this->youtube = $settingRepository->getRow('youtube');
        $this->twitter = $settingRepository->getRow('twitter');
        $this->about_footer = $settingRepository->getRow('footer_about');
        $this->users_can_send_teacher_request = $settingRepository->getRow('users_can_send_teacher_request') ?? false;
        $this->autographs = $settingRepository->getRow('autographs');
    }

    public function render()

    {
        return view('new.layouts.footer');
    }

    public function search()
    {
        if (!is_null($this->search)) {
            redirect()->route('articles',['q'=>$this->search]);
        }
    }

    public function checkCertificate()
    {
        $x = Transcript::where('certificate_code', $this->cert)->first();

        if (is_null($x)){
           $this->emitShowModalCert('گواهی نامه یافت نشد','گواهی نامه با این شماره وجود ندارد','error');
           
        }else{
            $course = $x->course;
            $courseTitle = $course->title;
            $score =$x->score;
            $name = $x->user->details->fullName;
            $text = "قبولی $name در $courseTitle با نمره  $score";
            $title  = 'گواهی نامه مورد تایید است';
            $this->emitShowModalCert($title,$text,'success');
        }
    }

    public function emitShowModalCert($title,$text,$icon)
    {
        $data['title'] = $title;
        $data['text'] = $text;
        $data['icon'] = $icon;

        $this->emit('showModal',$data);
    }
}
