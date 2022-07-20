<?php

namespace App\classe;
use Mailjet\Resources;

class Mail
{
    private $api_key = '09965f0bf764a0b84840c00848247e38';
    private $api_secret = '2a8db507f0554660d97e2d1ff962991e';

    public function send($to_email,$to_name)
    {  
$mj = new \Mailjet\Client(getenv('09965f0bf764a0b84840c00848247e38'), getenv('2a8db507f0554660d97e2d1ff962991e'),true,['version' => 'v3']);
$body = [
    'Messages' => [
        [
            'From' => [
                'Email' => "ericantonio123456@gmail.com",
                'Name' => "Ilahimora"
            ],
            'To' => [
                [
                    'Email' => $to_email,
                    'Name' => $to_name
                ]
            ],
            'TemplateID' => 4083120,
            'TemplateLanguage' => true,
            'Subject' => "Your email flight plan!"
        ]
    ]
];
$response = $mj->post(Resources::$Email, ['body' => $body]);
$response->success() && dd($response->getData());

    }
}