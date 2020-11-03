<?php 

    namespace DAO;
    use Models\Screening as Screening;
    use DAO\MovieBdDao as MovieBdDAO;
    use DAO\RoomBdDao as RoomBdDAO;
use FFI\Exception;

/*  create table if not exists screening(
        id_screening BIGINT UNSIGNED not null auto_increment,
        idroom BIGINT UNSIGNED not null,
        idmovie BIGINT UNSIGNED not null ,
        date_screening DATE not null,
        hour_screening TIME not null,
        constraint pk_idscreenig PRIMARY KEY (id_screening),
        constraint fk_idmovie FOREIGN KEY (idmovie) references movie(id_movie),
        constraint fk_idroom FOREIGN KEY (idroom) references room(id_room)
        ); 
    */

    class ScreeningBdDAO {

        private $connection;
        private $tableName = "screening";

        public function SaveScreeningInBd(Screening $screening) {

            $sql = "INSERT INTO " .$this->tableName. "(idcinema, idmovie, date_screening, hour_screening) VALUES (:idcinema, :idmovie, :date_screening, :hour_screening)";

            $parameters["idcinema"] = $screening->getCinema()->getId_Cinema();
            $parameters["idmovie"] = $screening->getMovie()->getId_movie();
            $parameters["date_screening"] = $screening->getDate_screening();
            $parameters["hour_screening"] = $screening->getHour_screening();
    
            try {
                $this->connection = Connection::GetInstance();
                return $this->connection->ExecuteNonQuery($sql, $parameters);
            } catch (Exception $ex) {
                throw $ex;
            }
        }

        private function getScreeningsFromDB(){
        
            $query = "SELECT * FROM " . $this->tableName;
            try {
                $this->connection = Connection::GetInstance();
                $result = $this->connection->Execute($query);
    
            } catch (Exception $ex) {
                throw $ex;
            }
            
            return $result;
        
        }

        public function getAllScreening() {

            $screeningArray = $this->getScreeningsFromDB();
            if(!empty($screeningArray)) {
                
                $result = $this->mapear($screeningArray);
                if(is_array($result)) {
                    $this->cinemasList = $result;
                }
                else {
                    $arrayResult[0] = $result;
                    $this->cinemasList = $arrayResult;
                }
                return $this->cinemasList;
            }
            else {
                return $errorArray[0] = "Error al leer la base de datos.";
            }
    
        }

        public function DeleteScreeningInDB($id_screening) {
  
            $sql = "DELETE FROM screening WHERE id_screening = :id_screening";
      
            $parameters["id_screening"] = $id_screening;
    
            try {
    
                $this->connection = Connection::GetInstance();
                return $this->connection->ExecuteNonQuery($sql, $parameters);
    
            } catch (Exception $ex){
                throw $ex;
            }
        }


        protected function mapear($value) {


            $value = is_array($value) ? $value : [];

            $resp = array_map(function($p){
                $cinema = new Screening($p['date_screening'], $p['hour_screening'], MovieBdDAO::MapearMovie($p["idmovie"]) ,CinemaBdDao::MapearCinema($p["idcinema"]));
                $cinema->setId_screening($p['id_screening']);
                return $cinema;
    
            }, $value);
    
            return count($resp) > 1 ? $resp : $resp['0'];
        }








    }




?>