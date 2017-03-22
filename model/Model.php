<?php

class Model
{
    public $memcache = null;

    public function __construct()
    {
        $this->memcache = new Memcache();
        $this->memcache->connect('localhost', 11211) or die("Could not connect to chat.");
    }

    public function addMessage($username, $message)
    {
        $messageId = $this->memcache->increment('totalMessages', 1); // No funciona el inicializar.

        if (!$messageId) {
            $messageId = 1;
            $this->memcache->set('totalMessages', 1);
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

        $totalMessages = $this->memcache->get('totalMessages');
        for ($i = 0; $i <= $totalMessages; $i++) {
            $messages[] = array(
                'username' => $this->memcache->get('message:' . $i . ':user'),
                'message' => $this->memcache->get('message:' . $i)
            );
        }

        return $messages;
    }
}
