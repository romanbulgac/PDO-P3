<?php
session_start();
class UserReg
{
    public $id;
    public $login;
    public $pass;
    public $username;
    public $admin;
    public $birthday;
    public $email;
    public $con;


    public function __construct($userId)
    {
        $xml_data = simplexml_load_file("users.xml") or die("Failed to load");
        $item = $xml_data->xpath("//user[id=$userId]")[0];
        $this->id = $item->id;
        $this->login = $item->login;
        $this->pass = $item->password;
        if (!isset($item->lastname))
            $row['lastname'] = '';
        $this->username = $item->firstname . " " . $item->lastname;
        $this->admin = $item->admin;
        $this->birthday = $item->birthday;
        $this->email = $item->email;
    }
    static public function login($login, $pass)
    {
        $xml_data = simplexml_load_file("users.xml") or die("Failed to load");
        $item = $xml_data->xpath("//user[login='$login']")[0];
        if (isset($item)) {
            if (md5($pass) == $item->password) {
                $_SESSION['login'] = $login;
                $_SESSION['pass'] = md5($pass);
                return true;
            }
        } else {
            return true;
        }
    }

    static public function loginById($id)
    {
        $xml_data = simplexml_load_file("users.xml") or die("Failed to load");
        $item = $xml_data->xpath("//user[id=$id]")[0];
        if (isset($item)) {
            $user = new UserReg($id);
            return $user;
        } else {
            return null;
        }
    }
    static public function loginSession($login, $hashPass)
    {
        $xml_data = simplexml_load_file("users.xml") or die("Failed to load");
        $item = $xml_data->xpath("//user[login='$login']")[0];
        // print_r($item);
        if (isset($item)) {
            if ($hashPass == $item->password) {
                return new UserReg($item->id);
            }
        }
        return false;
    }
    static public function register($login, $password, $firstname, $lastname, $email, $birthday)
    {
        $xml_data = simplexml_load_file("users.xml") or die("Failed to load");
        $newItem = $xml_data->addChild('user');
        $newItem->addChild('id', $xml_data->xpath("//user")[count($xml_data->xpath("//user")) - 1]->id + 1);
        $newItem->addChild('login', $login);
        $newItem->addChild('password', md5($password));
        $newItem->addChild('firstname', $firstname);
        $newItem->addChild('lastname', $lastname);
        $newItem->addChild('email', $email);
        $newItem->addChild('birthday', $birthday);
        $newItem->addChild('admin', 0);
        file_put_contents('users.xml', $xml_data->asXML());
        $_SESSION['login'] = $login;
        $_SESSION['pass'] = md5($password);
    }
    public static function loginRepeat($login)
    {
        $xml_data = simplexml_load_file("users.xml") or die("Failed to load");
        $item = $xml_data->xpath("//user[login=$login]");
        return count($item) > 0;
    }
    public static function emailRepeat($email)
    {
        $xml_data = simplexml_load_file("users.xml") or die("Failed to load");
        $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
        $item = $xml_data->xpath("//user[email='$email']");
        return !empty($item);
    }
}
