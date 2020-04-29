<?php

require_once("database.php");

class TMPL extends DB
{
    public $table_name;

    public function __construct()
    {
        parent::__construct();

        require_once(MODEL_PATH . 'log.php');
    }

    //Metoda pobiera wyłącznie właściwości publiczne z obiektu potomnego i zwraca w postaci tablicy asocjacyjnej
    public function getChildProperties()
    {
        $properties = [];
        try {
            $rc = new ReflectionClass($this);

            foreach ($rc->getProperties(ReflectionProperty::IS_PUBLIC) as $p) {
                if ($rc->name == $p->class) {
                    $p->setAccessible(true);

                    $properties[$p->getName()] = $p->getValue($this);
                }
            }
        } catch (ReflectionException $e) {
            //Tools::showObj($e);
        }
        return $properties;
    }

    //get(id) - pobiera dane z bazy i uzupełnia właściwości obiektu potomnego
    public function get($id = NULL)
    {
        $data = $this->Query("SELECT * FROM {$this->table_name} WHERE Id = " . ($id ? $id : $this->Id) . ";");

        if (count($data)) {

            foreach ($this->getChildProperties() as $col_name => $value) {
                $this->$col_name = $data[0]->$col_name;
            }
        }
    }




    //Metoda zapisuje aktualny obiekt potomny do bazy danych
    public function save()
    {
        $sqlA = "";
        $sqlB = "";

        foreach ($this->getChildProperties() as $col_name => $value) {
            $sqlA .= "`{$col_name}`, ";
            $sqlB .= "'{$value}', ";
        }

        $sqlA = rtrim($sqlA, ", ");
        $sqlB = rtrim($sqlB, ", ");

        $query = "INSERT INTO {$this->table_name} ( {$sqlA} ) VALUES( {$sqlB} );";
        // echo '<br>'.$query;
        // echo $query;
        $res = $this->Query($query);
        $this->Id = $res;

        //Zapis do logów
        $user_Id = $this->Id;
        $object_operation_id = $res;
        if (get_class($this) == 'Post') {
            $user_Id = $this->UserId;
        }

        Log::Write(get_class($this), Log::INSERT, $user_Id, $object_operation_id);
        //echo $res;
        return $res;
    }



    //usuwa dane konkretnego obiektu na podstawie numeru Id
    function delete()
    {

        $query = "DELETE FROM {$this->table_name} WHERE Id = {$this->Id};";

        $res = $this->Query($query);


        // Log::Write(get_class($this), Log::DELETE, $user_save, $this->Id, '');

        $user_Id = $this->Id;
        $object_operation_id = $this->Id;
        if (get_class($this) == 'Post') {
            $user_Id = $this->UserId;
        }
        if (get_class($this) == 'User') {
            $user_Id = "Usuniety(Id: $user_Id)";
        }

        Log::Write(get_class($this), Log::DELETE, $user_Id, $object_operation_id);



        return $res;
    }

    //aktualizuje dany obiekt na podstawie numeru Id
    function update()
    {

        $sqlA = "";

        foreach ($this->getChildProperties() as $col_name => $value) {
            if ($value != null) {
                $sqlA .= "`{$col_name}` = '{$value}', ";
            }
        }

        $sqlA = rtrim($sqlA, ", ");

        $res = $this->Query("UPDATE {$this->table_name} SET {$sqlA} WHERE Id = {$this->Id};");




        //Zapis do logów
        $user_Id = $this->Id;
        $object_operation_id = $this->Id;
        if (get_class($this) == 'Post') {
            $user_Id = $this->UserId;
        }

        Log::Write(get_class($this), Log::UPDATE, $user_Id, $object_operation_id);


        return $res;
    }
}
