<?php
abstract class Model{
    protected $Conn;
    protected $TableName;

    protected function __construct($db) {
        $this->Conn = $db;
    }

    abstract public function read();
    abstract  public function update();
    abstract public function delete();
}