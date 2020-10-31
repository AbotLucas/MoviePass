<?php

    namespace Controllers;
    use Models\Screening as Screening;
    use DAO\ScreeningDao as ScreeningDao;

    class ScreeningController {

        private $screeningDAO;
/*     <li><a href="<?php echo FRONT_ROOT."Screening/ShowAddScreeningView" ?>">Add Screening</a></li>
    <li><a href="<?php echo FRONT_ROOT."Screening/ShowListScreeningView" ?>">Show List</a></li> */
    
        public function ShowAddScreeningView($message = "") {
            require_once(VIEWS_PATH."screening-add.php");
        }

        public function ShowListScreeningView($message = "") {
            require_once(VIEWS_PATH."screening-list.php");
        }

        public function AddScreening() {

            if($_POST) {

                


            }
        }

        





}



?>