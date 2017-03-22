<?php
include_once("model/Model.php");

class Controller
{
    public $model;

    public function __construct()
    {
        $this->model = new Model();
    }

    public function invoke()
    {
        if (isset($_POST['message'])) {
            $this->model->addMessage('User', $_POST['message']);
        }

        $messages = $this->model->getMessages();
        include 'view/chatView.php';
    }
}
