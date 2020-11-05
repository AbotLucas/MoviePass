<?php 
namespace DAO;

use Models\Room as Room;

interface Iroom
{
    function SaveRoomInBd($Room);
    function DeleteRoomInDB($id_room);
    function getAllRoom();
}
?>