<?php

namespace App\classe;

use Mailjet\Client;
use Mailjet\Resources;

class Mail
{
    private $api_key = '09965f0bf764a0b84840c00848247e38';
    private $api_secret = '2a8db507f0554660d97e2d1ff962991e';

    public function send($to_email,$subject,$titre,$contenu)
    {  
        $mj = new Client($this->api_key,$this->api_secret,true,['version' =>'v3.1']);
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
                
                ]
            ],
            'TemplateID' => 4083120,
            'TemplateLanguage' => true,
            'Subject' => $subject,
            'variables'=>[
                'titre'=>$titre,
                'content'=>$contenu
            ]
        ]
    ]
];
$response = $mj->post(Resources::$Email, ['body' => $body]);
$response->success() ;

    }
}