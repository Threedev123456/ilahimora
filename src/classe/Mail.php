<?php

namespace App\classe;

use Mailjet\Client;
use Mailjet\Resources;

class Mail
{
    private $api_key = '09965f0bf764a0b84840c00848247e38';
    private $api_secret = '2a8db507f0554660d97e2d1ff962991e';

    public function send($from_email,$to_email,$message)
    {
        $mj = new Client($this->api_key, $this->api_secret, true, ['version' => 'v3.1']);
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => $from_email,
                    ],
                    'To' => [
                        [
                            'Email' => $to_email,
                        ]
                    ],
                    'Subject' =>'commentaire Ilahimôra Meuble',
                    'TextPart' => $message,
                    'HTMLPart' => $message,
                    'CustomID' => "AppGettingStartedTest"
                ]
            ]
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        $response->success() && dd($response->getData());
    }
}