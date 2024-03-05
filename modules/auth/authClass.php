<?php

include_once "../../core/dbController.php";
include_once "../../core/helper.php";
include_once "../../core/constants.php";
class authClass extends dbController
{

    private $user;

    public function __construct()
    {

        $this->user = null;
        parent::__construct();
    }

    public function verifyLogin($formData)
    {


        $email = $formData['email'];
        $password = $formData['password'];
        $query = 'select * from '.DB_PREFIX.'users where email=:email and password=:password';
        $params = array(':email' => $email, ":password" => $password);

        $stmt = $this->runQuery($query, $params);
        $users = $this->fetchAllRows($stmt);
      

        if ($users) {
            $this->user = $users[0];

        }

    }


    public function createSessions()
    {

        $_SESSION["user"] = $this->user['id'];

    }

    public function getCurrentUser()
    {
        return $this->user;
    }
}