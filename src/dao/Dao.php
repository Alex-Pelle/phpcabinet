<?php
interface Dao {

    public function getAll();
    public function getById($cle);
    public function insert($item);
    public function update($item);
    public function delete($item);

}

?>