<?php 
namespace DAO;

use Models\BuyUp as BuyUp;

interface IbuyUp
{
    function SaveBuyUpInBd(BuyUp $buyup);
    function deleteBuyUp($id_BuyUp);
    function getAllBuyUp();
}
?>
