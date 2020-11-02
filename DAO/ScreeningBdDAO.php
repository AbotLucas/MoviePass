<?php 

    namespace DAO;
    use Models\Screening as Screening;

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

        public function SaveScreeningInBd($screening) {

            $sql = "INSERT INTO " .$this->tableName. " ";
    
            $parameters["userName"] = $user->GetUserName();
            $parameters["password"] = $user->GetPassword();
            $parameters["role"] = 2;
    
            try {
                $this->connection = Connection::GetInstance();
                return $this->connection->ExecuteNonQuery($sql, $parameters);
            } catch (Exception $ex) {
                throw $ex;
            }
        }








    }




?>