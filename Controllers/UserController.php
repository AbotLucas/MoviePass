<?php 

    namespace Controllers;

    use Models\User as User;
    use DAO\UserDAO as UserDao;
    use Controllers\MovieController as MovieController;
use DAO\UserBdDAO;

class UserController {


        private $userDAO;
        private $userBdDAO;

        public function __construct()
        {
           $this->userDAO = new UserDao();
           $this->userBdDAO = new UserBdDAO();
        }

        public function ShowSignUpView($message = "")
        {
            require_once(VIEWS_PATH."signup.php");
        } 
        public function ShowLogInView($message = "")
        {   
            if(!isset($_SESSION["loginUser"])){
                require_once(VIEWS_PATH."login.php");
            }
            else{
                $homeController = new HomeController();
                $homeController->Index("ERROR: No puede acceder a esa ruta");
            }
        } 

        public function SignUpValidate($email, $password, $password2) {

            if($password==$password2) {
                if($this->userBdDAO->GetByUserName($email)) {
                    $this->ShowSignUpView("That mail is already in use.");
                }
                else {
                    $newUser = new User($email, $password, 1);
                    $result = $this->userBdDAO->SaveUserInDB($newUser);
                    if($result == 1) {
                        $this->ShowLogInView("Sign Up succesfully! Now you can log in.");
                    }
                    else {
                        $this->ShowLogInView("Error in Sign Up, please try again.");
                    }
                }
            }
            else {
                $this->ShowSignUpView("Password's must be equal");
            }

        }

        public function LogInValidate($email,  $password) {
            if(!isset($_SESSION["loginUser"])){
            $user = $this->userBdDAO->GetByUserName($email);
            if($user) {
                if($user->getPassword() == $password) {
                    $movieController = new MovieController();
                    $_SESSION["loginUser"] = $user;
                    $movieController->listMovies("Welcome!");
                }
                else {
                    $this->ShowLogInView("ERROR: Password incorrect!");
                }
            }
            else {
                $this->ShowLogInView("ERROR: The entered email is not registered");
            }}
            else {
                $this->ShowLogInView("ERROR: You are already logged in!");
            }
        }





    }






?>