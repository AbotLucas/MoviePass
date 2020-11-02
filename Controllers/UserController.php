<?php 

    namespace Controllers;

    use Models\User as User;
    use DAO\UserDAO as UserDao;
    use Controllers\MovieController as MovieController;

    class UserController {


        private $userDAO;

        public function __construct()
        {
           $this->userDAO = new UserDao();
        }

        public function ShowSignUpView($message = "")
        {
            require_once(VIEWS_PATH."signup.php");
        } 
        public function ShowLogInView($message = "")
        {
            require_once(VIEWS_PATH."login.php");
        } 

        public function SignUpValidate($email, $password, $password2) {

            if($password==$password2) {
                if($this->userDAO->SearchEmailInDB($email)) {
                    $this->ShowSignUpView("That mail is already in use.");
                }
                else {
                    $newUser = new User($email, $password, 1);
                    $result = $this->userDAO->SaveUserInDB($newUser);
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

            $user = $this->userDAO->SearchEmailInDB($email);
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
            }
        }





    }






?>