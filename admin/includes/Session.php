<?php

declare( strict_types=1 );

class Session
{
    /**
     * @var int
     */
    public $user_id;
    /**
     * @var string
     */
    public $message;
    /**
     * @var int
     */
    public $count;
    /**
     * @var bool
     */
    private $signed_in = FALSE;

    function __construct()
    {
        $this->count = $_SESSION['count'];
        session_start();
        $this->check_the_login();
        $this->check_message();
        $this->visitor_count();

    }

    private function check_the_login()
    {
        if (isset($_SESSION['user_id'])) {
            $this->user_id = $_SESSION['user_id'];

            $this->signed_in = TRUE;
        } else {
            unset($this->user_id);
            $this->signed_in = FALSE;
        }
    }

    /**
     *With that method we check is session message is set
     * if is set we get that message and we apply to our message property
     * $this->message end the we unset message from $_SESSION['message']
     * else if is not set assign empty message no $this->message property so no
     * get any error
     */
    public function check_message()
    {
        if (isset($_SESSION['message'])) {
            $this->message = $_SESSION['message'];
            unset($_SESSION['message']);
        } else {
            $this->message = "";
        }
    }

    /**
     * @return int
     */
    public function visitor_count()
    {


        if (isset($_SESSION['count'])) {

            return $this->count = $_SESSION['count']++;

        } else {
            return $_SESSION['count'] = 1;
        }
    }

    public function is_logged_in()
    {
        return $this->signed_in;

    }

    /**
     * With that method we manage login user
     *
     * @param $user
     */
    public function login($user)
    {
        if ($user) {
            $this->user_id = $_SESSION['user_id'] = $user->id;
            $this->signed_in = TRUE;
        }
    }

    /**
     *This method manage user logout from our system
     */
    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($this->user_id);
        session_destroy();
        $this->signed_in = FALSE;
        redirect("index.php");
    }

    /**
     * We have a msg variable then we check if
     * msg is not empty and then we assign that message
     * on session message var.Else if msg is not empty we return message
     *
     * @param string $msg
     *
     * @return mixed
     */
    public function message($msg = "")
    {

        if (!empty($msg)) {
            $_SESSION['message'] = $msg;
        } else {
            return $this->message();
        }
    }

}

$session = new Session();
