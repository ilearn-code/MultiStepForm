<?php

include_once "../../core/dbController.php";
include_once "../../core/helper.php";
class userClass extends dbController
{

    private $user;

    public function __construct()
    {

        $this->user = null;
        parent::__construct();
    }

    public function getUserByEmail($email)
    {


        $query = 'select * from '.DB_PREFIX.'users where email=:email';
        $params = array(':email' => $email);
        $stmt = $this->runQuery($query, $params);
        $users = $this->fetchAllRows($stmt);

        if (!empty($users)) {
            return $users[0];

        }
        return null;

    }



    public function createUser($formData)
    {


        $full_name = $formData['full_name'];
        $full_name = explode(" ", $full_name);
        $first_name = $full_name[0];
        $last_name = isset($full_name[1]) ? $full_name[1] : null;


        $email = $formData['email'];
        $password = $formData['password'];

        $query = 'insert into '.DB_PREFIX.'users (first_name , last_name , status ,email , password) values (:first_name , :last_name,:status, :email , :password)';
        $params = array(':first_name' => $first_name, ':last_name' => $last_name, ':status' => 2, ':email' => $email, ":password" => $password);

        pr($params);
        return $this->insertQuery($query, $params);

    }


    public function notifyToAdmin()
    {

    }
    public function notifyToUSer()
    {

    }





}