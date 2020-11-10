<?php 

    namespace DAO;
    use Models\Screening as Screening;
    use DAO\MovieBdDao as MovieBdDAO;
    use DAO\RoomBdDao as RoomBdDAO;
use FFI\Exception;
use Models\Room;

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
        private $listScreening = [];



        public function SaveScreeningInBd(Screening $screening) {

            $sql = "INSERT INTO " .$this->tableName. "(idroom, idmovie, date_screening, hour_screening) VALUES (:idroom, :idmovie, :date_screening, :hour_screening)";

            $parameters["idroom"] = $screening->getRoom()->getId_room();
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

                return null;
            }
            
            return $result;
        
        }

        public function getAllScreening() {

            $screeningArray = $this->getScreeningsFromDB();

            if(!empty($screeningArray)) {
                
                $result = $this->mapear($screeningArray);
                
                if(is_array($result)) {
                    
                    $this->listScreening = $result;
                }
                else {
                    
                    $arrayResult[0] = $result;
                    $this->listScreening = $arrayResult;
                }
                
                return $this->listScreening;
            }
            else {
                return $errorArray[0] = "Error al leer la base de datos.";
            }
    
        }

        private function getScreeningsFromARoomDB($id_room){
        
            $query = "SELECT * FROM " . $this->tableName . " WHERE idroom = :idroom";

            $parameters["idroom"] = intval($id_room);

            try {
            
                $this->connection = Connection::GetInstance();
                $result = $this->connection->Execute($query, $parameters);
    
            } catch (Exception $ex) {

                return null;
            }
            
            return $result;
        
        }

        public function GetScreeningsFromARoom($id_room) {

            $screeningArray = $this->getScreeningsFromARoomDB($id_room);

            if(!empty($screeningArray)) {
                
                $result = $this->mapear($screeningArray);
                
                if(is_array($result)) {
                    
                    $this->listScreening = $result;
                }
                else {
                    
                    $arrayResult[0] = $result;
                    $this->listScreening = $arrayResult;
                }
                
                return $this->listScreening;
            }
            else {
                return $errorArray[0] = "Error al leer la base de datos.";
            }
    
        }

        private function getScreeningsFromAMovieDB($id_movie){
        
            $query = "SELECT * FROM " . $this->tableName . " WHERE idmovie = :idmovie ORDER BY date_screening ASC";

            $parameters["idmovie"] = intval($id_movie);

            try {
            
                $this->connection = Connection::GetInstance();
                $result = $this->connection->Execute($query, $parameters);
    
            } catch (Exception $ex) {

                return null;
            }
            
            return $result;
        
        }

        public function GetScreeningsFromAMovie($id_movie) {

            $screeningArray = $this->getScreeningsFromAMovieDB($id_movie);

            if(!empty($screeningArray)) {
                
                $result = $this->mapear($screeningArray);
                
                if(is_array($result)) {
                    
                    $this->listScreening = $result;
                }
                else {
                    
                    $arrayResult[0] = $result;
                    $this->listScreening = $arrayResult;
                }
                
                return $this->listScreening;
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
                $cinema = new Screening($p['date_screening'], $p['hour_screening'], MovieBdDAO::MapearMovie($p["idmovie"]) ,RoomBdDAO::MapearRoom($p["idroom"]));
                $cinema->setId_screening($p['id_screening']);
                return $cinema;
    
            }, $value);
    
            return count($resp) > 1 ? $resp : $resp['0'];
        }

        public function GetGenresOfScreenings() {
            
            $genderList = $this->BringGenresOfScreeningsDb();
            $result = [];

            if(!empty($genderList)) {
                
                foreach($genderList as $genre) {
                    array_push($result, GenreBdDAO::MapearGenre($genre["id_genre"]));
                }
                
                if(is_array($result)) {
                    
                    return $result;
                }
                else {
                    
                    $arrayResult[0] = $result;
                    return $arrayResult;
                }
            }
            else {
                return $errorArray[0] = "No hay generos cargados. ERROR";
            }

        }

        private function BringGenresOfScreeningsDb() {

            $query = "select distinct g.id_genre, g.genrename 
                        FROM movie m
                        inner join screening s
                        on m.id_movie = s.idmovie
                        inner join genre g
                        on m.idgenre = g.id_genre;";

            try{

                $this->connection = Connection::GetInstance();
                return $this->connection->Execute($query);


            } catch (Exception $ex) {

                throw $ex->getMessage();
            }

        }
        public function GetDatesOfScreenings() {
            
            $datesList = $this->BringDatesOfScreeningsDb();

            if(!empty($datesList)) {

                return $datesList;
                
            }
            else {
                return $errorArray[0] = "No hay generos cargados. ERROR";
            }

        }

        private function BringDatesOfScreeningsDb() {

            $query = "select distinct s.date_screening
                        from screening s;";

            try{

                $this->connection = Connection::GetInstance();
                return $this->connection->Execute($query);


            } catch (Exception $ex) {

                throw $ex->getMessage();
            }

        }

        public function ModifyScreeningInBd($id_screening, $id_movie, $data, $hour) {

            $query = "UPDATE " . $this->tableName . " SET idmovie=:idmovie, date_screening =:date_screening , hour_screening=:hour_screening WHERE (id_screening=:id_screening)";
           
            $parameters["id_screening"] = $id_screening;
            $parameters["idmovie"] = $id_movie;
            $parameters["date_screening "] = $data;
            $parameters["hour_screening"] = $hour;
           
    
            try {
                $this->connection = Connection::GetInstance();
                return $this->connection->ExecuteNonQuery($query, $parameters);
            } catch (Exception $ex) {
                throw $ex;
            }

    }
    }

?>