<?php 

interface DataAccess{

   
    public function getAllItems();
    public function insert($item);
    public function delete($item);



}


?>