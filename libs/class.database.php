<?php

class Database extends PDO
{
    
    public function __construct($DB_TYPE, $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS)
    {
         parent::__construct($DB_TYPE.':host=' .$DB_HOST. ';dbname=' .$DB_NAME, $DB_USER, $DB_PASS); 
    }


    /**
     * @param STRING $sql An SQL string
     * @param INTEGER $f The SQL fetchType 2 or 1. 
     * The default is 2, which converts the select into a 'fetchAll' retrieval. 
     * 1 sets it to 'fetch'
     * @param ARRAY $data Parameters to bind
     * @param CONSTANT $fetchStyle A PDO Fetch style (Associative is default: 'PDO::FETCH_ASSOC' )
     * @return MIXED 
     * 
     */
    public function select($sql, $f = 2, $array = array(), $fetchStyle = PDO::FETCH_ASSOC){ 
        $sth = $this->prepare($sql);
        foreach ($array as $key => $value) {
            $sth->bindValue("$key", $value);
        }
        if($f === 1){
            $fetchType = 'fetch';
            }
        elseif($f === 2) {
            $fetchType = 'fetchAll';
        }
        else{
            echo "Error, problem with fetchType variable, input was '$fetchType', should be 1 or 2";
        }
        $sth->execute();
        return $sth->$fetchType($fetchStyle);
    }
    /**
     * insert
     * @param STRING $table Name of table to insert into
     * @param STRING $data An associative array
     */
    public function insert($table, $data){
        ksort($data); //not necessary, but JREAM likes things to be alphabetized for reasons.
 
        $fieldNames = implode('`, `', array_keys($data));//`login`,`password`,`role`
        $fieldValues = ':' . implode(', :', array_keys($data)); //:login,:password,:role

        $sth = $this->prepare("INSERT INTO $table (`$fieldNames`) VALUES($fieldValues)");

        foreach($data as $key => $value) {
            $sth->bindValue(":$key", $value);
        }

        $sth->execute();
    }

    /**
     * update
     * @param STRING $table (Name of table to insert into)
     * @param STRING $data (An associative array)
     * @param STRING $where (location that the WHERE portion of the query points to)
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
/**
 * Delete
 * 
 * @param STRING $table the table to delete from
 * @param STRING $where The query identifier
 * @param INTEGER $limit Query limit (default is 1) 
 * @return INTEGER Affected Rows
 * 
 */
    public function delete($table, $where, $limit = 1)
    {
         return $this->exec("DELETE FROM $table WHERE $where LIMIT $limit");
        }



}
