<?php
    namespace Controllers;

    use DAO\UserDao as UserDao;
    use Models\User as User;

    class SessionController {
       
        private $userDAO ;

        public function __construct()
        {
           $this->userDAO = new UserDao();
        }

        //SignUp function

        public function ShowSignUpView($message = "")
        {
            require_once(VIEWS_PATH."signup.php");
        } 
        public function ShowLogInView($message = "")
        {
            require_once(VIEWS_PATH."login.php");
        }       
       

        public function ShowAddCinema($message = "") {
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."cinema-add.php");
        }
        
    
       public function CheckAdminLogin($username, $password)
        {
            $user = $this->userDAO->GetUserName($username);

            if(($user != null) && ($user->getPassword() === $password))
            {

                $_SESSION["loginUser"] = $user;
                
                $this->ShowAddCinema();
            }
            else{
                $this->ShowLogInView("incorrect user");
            }
        }
        
        //LogOutFunction

        public function SessionDestroy(){
            //var_dump($_SESSION['loginUser']);
            if(isset($_SESSION))
                if(!empty($_SESSION['loginUser']))
                    $_SESSION['loginUser'] = null;
            //var_dump($_SESSION['loginUser']);
            $this->ShowLogInView();

         }

    }    

        
?>