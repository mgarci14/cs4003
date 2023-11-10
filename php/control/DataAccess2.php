<?php
interface DataAccess {
    public function findById($id);
    public function findAll();
    public function create($entity);
    public function update($entity);
    public function delete($id);
}
?>
