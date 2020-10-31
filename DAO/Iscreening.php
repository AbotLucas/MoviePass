<?php 
namespace DAO;

use Models\Screening as Screening;

interface Iscreenig
{
    function addScreening(Screening $Screening);
    function deleteScreening($id_screening);
    function getAllScreenings();
}
?>