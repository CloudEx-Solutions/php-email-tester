<?php
namespace App;
require 'vendor/autoload.php';

use Cake\Mailer\Email;
# define gmail transport
Email::setConfigTransport('gmail', [
    'className' => 'Smtp',
    'host' => 'smtp.gmail.com',
    'port' => 587,
    'username' => 'USER',
    'password' => 'PASS',
    'tls' => true,
]);

try {
    $email = new Email();
    $email->setFrom(['USER' => 'Test Sender'])
        ->setTo($argv[1])
        ->setSubject('Email test')
        ->setTransport('gmail')
        ->send('This is a test email');
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getTraceAsString(), "\n";
}
?>