<?php
/**
 * Created by PhpStorm.
 * User: Xtrazyx
 * Date: 31/08/2017
 * Time: 13:05
 */

namespace JHD\Framework;

use Swift_Mailer;
use Swift_SmtpTransport;

trait SwiftMailer
{
    public function getMailer()
    {
        $config = new Config();

        // Create the Transport
        $transport = new Swift_SmtpTransport(
            $config->getConfigsByKey('swift_mailer')['smtpHost'],
            $config->getConfigsByKey('swift_mailer')['port']
        );

        $transport
            ->setUsername($config->getConfigsByKey('swift_mailer')['userName'])
            ->setPassword($config->getConfigsByKey('swift_mailer')['password']);

        // Create the Mailer using your created Transport
        $mailer = new Swift_Mailer($transport);

        return $mailer;
    }
}