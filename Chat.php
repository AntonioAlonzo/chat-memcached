<?php

class Chat
{
    public $memcache = null;

    public function __construct($memcache)
    {
        $this->memcache = $memcache;
    }

    public function addMessage($username, $message)
    {
        $messageId = $this->memcache->increment('total', 1, 0); // No funciona el inicializar.

        if (!$messageId) {
            $messageId = 0;
            $this->memcache->set('total', 1);
        }

        $this->memcache->set('message:' . $messageId, $message);
        $this->memcache->set('message:' . $messageId . ':user', $username);
    }

    public function getMessage($messageId)
    {
        $message = array();

        $message['message'] = $this->memcache->get('message:' . $messageId);
        $message['user'] = $this->memcache->get('message:' . $messageId . ':user');

        return $message;
    }

    public function getMessages()
    {
        $messages = array();

        $totalMessages = $this->memcache->get('total');
        for ($i = 0; $i <= $totalMessages; $i++) {
            $messages[] = array(
                'username' => $this->memcache->get('message:' . $i . ':user'),
                'message' => $this->memcache->get('message:' . $i)
            );
        }

        return $messages;
    }
}

$memcache = new Memcache();
$memcache->connect('localhost', 11211) or die("Could not connect to chat.");

$chat = new Chat($memcache);
$chat->addMessage('Mar', 'Mensaje 1');
$chat->addMessage('Tony', 'Mensaje 2');
$chat->addMessage('Felix', 'Mensaje 3');

$messages = $chat->getMessages();
foreach ($messages as $message) {
    echo $message['username'] . " dice: " . $message['message'] . "<br />";
}
