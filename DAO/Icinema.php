<?php 
namespace DAO;

use Models\Cinema as Cinema;

interface Icinema
{
    function addCinema(Cinema $cinema);
    function deleteCinema($id_Cinema);
    function getAllCinema();
}
?>