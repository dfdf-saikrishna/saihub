<?php

function sendMail($to, $message, $subject)
{
    global $app;
    $mailsetting = unserialize(getSetting('mail'));
    if ($mailsetting != '' && $mailsetting['mailmode'] == 'smtp') {
        $message = \Swift_Message::newInstance()
                    ->setSubject($subject)
                    ->setFrom(array($mailsetting['uname'] => $mailsetting['sender']))
                    ->setTo(array($to))
                    ->setBody($message, 'text/html');
        $app['mailer']->send($message);
    } elseif ($mailsetting['mailmode'] == 'phpmail') {
        // To send HTML mail, the Content-type header must be set
        $headers = 'MIME-Version: 1.0'."\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";

        // Additional headers
        $headers .= 'To: '.$to."\r\n";
        $headers .= 'From: '.$mailsetting['sender'].' <'.$mailsetting['uname'].'>'."\r\n";

        // Mail it
        mail($to, $subject, $message, $headers);
    }
}
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
