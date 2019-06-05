<?php

class Database extends PDO
{
    
    public function __construct($DB_TYPE, $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS)
    {
         parent::__construct($DB_TYPE.':host=' .$DB_HOST. ';dbname=' .$DB_NAME, $DB_USER, $DB_PASS); 
    }
    /**
     * insert
     * @param string $table Name of table to insert into
     * @param string $data An associative array
     */
    public function insert($table, $data){
        ksort($data); //not necessary, but JREAM likes things to be alphabetized for reasons.
 
        $fieldNames = implode('`, `', array_keys($data));//`login`,`password`,`role`
        $fieldValues = ':' . implode(', :', array_keys($data)); //:login,:password,:role

        $sth = $this->prepare("INSERT INTO $table (`$fieldNames`) VALUES($fieldValues)");
// die;
        foreach($data as $key => $value) {
            $sth->bindValue(":$key", $value);
            // echo $key . ' ' . $value . '</br>';
        }
        // print_r($data);
        // echo '<br>';
        // print_r($sth);
        // die;
        $sth->execute();//erroring on create 
    }

    /**
     * update
     * @param string $table (Name of table to insert into)
     * @param string $data (An associative array)
     * @param string $where (location that the WHERE portion of the query points to)
     */
    public function update($table, $data, $where){
        ksort($data);
        
        $fieldDetails = NULL;//why is this still null
        foreach ($data as $key=> $value) {
            $fieldDetails .= "`$key`=:$key,";
        }
        $fieldDetails = rtrim($fieldDetails, ',');
    
        $sth = $this->prepare("UPDATE $table SET $fieldDetails WHERE $where");

        foreach ($data as $key => $value) {
            $sth->bindValue(":$key", $value);
        }

        $sth->execute();
    }







}
