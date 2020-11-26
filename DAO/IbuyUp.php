<?php 
namespace DAO;

use Models\BuyUp as BuyUp;

interface IbuyUp
{
    function SaveBuyUpInBd($id_ticket , $ticketquantity);
    function deleteBuyUp($id_BuyUp);
    function getAllBuyUp();
}
?>
