<?php 
namespace DAO;

use DAO\Iscreenig as Iscreening;
use Models\Screening as Screening;

class ScreeningDao implements Iscreening 
{

    private $screening_list = array();
    private $fileNameScreening;
 
    public function __construct()
    {
      $this->fileNameScreening = ROOT."/Data/Screenings.json";
    }

    public function GetNextId_screening(){
        $id = 0;

        foreach($this->screening_list as $screening){
            $id = ($screening->getId_screening() > $id) ? $screening->getId_screening() : $id;
        }
        return $id + 1;
    }
 
    public function addScreening(Screening $screening){
        $this->retrieveData();
        array_push($this->listCinema, $screening);
        $this->saveData();
    }

     public function deleteScreening($id_Screening){
        $this->retrieveData();
		$newList = array();
		foreach ($this->screening_list as $screening) {
			if($screening->getId_screening() != $id_Screening){
				array_push($newList, $screening);
			}
		}
		$this->listCinema = $newList;
		$this->saveData();
    }
    
     public function getAllScreenings(){
        $this->retrieveData();
        return $this->screening_list;
    
    }

 private function retrieveData(){

       $this->screening_list = array();

       if (file_exists($this->fileNameScreening)){
           $jsonContent = file_get_contents($this->fileNameScreening);

           $arrayToDecode = ($jsonContent) ? json_decode($jsonContent,true) : array();

           foreach($arrayToDecode as $valueArray){
               $screening = new Screening($valueArray["date_screening"], $valueArray["hour_screening"], $valueArray["id_movie_screening"], $valueArray["id_cinema_screening"]);
               array_push($this->screening_list, $screening);
           }
       }
    }


    private function saveData(){

		$arrayToEncode = array();

		foreach ($this->screening_list as $screening) {
            
			$valueArray['id_screening'] =$screening->getId_screening();
			$valueArray['date_screening'] =$screening->getDate_screening();
			$valueArray['id_movie_screening'] =$screening->getId_movie_screening();
            $valueArray['id_cinema_screening'] =$screening->getId_cinema_screening();
			
			array_push($arrayToEncode, $valueArray);
			
        }
        
		$jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
		file_put_contents($this->fileNameScreening, $jsonContent);
    }
    
    protected function mapear($value) {

        $value = is_array($value) ? $value : [];

        $resp = array_map(function($p){
            return new Screening($p['id_screening'], $p['date_screening'], $p["hour_screening"], MovieBdDAO::MapearMovie($p['idmovie']), RoomBdDAO::MapearRoom($p['idroom']));
        }, $value);

        return count($resp) > 1 ? $resp : $resp['0'];
    }
	

}

?>