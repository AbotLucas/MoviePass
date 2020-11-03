<?php 
namespace DAO;

use Models\Room as Room;

interface Iroom
{
    function addRoom(Room $Room);
    function deleteRoom($id_room);
    function getAllRoom();
}
?>