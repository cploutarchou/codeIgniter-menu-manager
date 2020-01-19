<?php
declare( strict_types=1 );

class DBObject
{

    /**
     * @var string
     */
    protected static $db_table = "photos";


    public static function find_all()
    {
        return static::find_by_query("SELECT * FROM " . static::$db_table . " ");
    }

    public static function find_by_query($query)
    {
        global $database;
        $result = $database->query($query);
        $the_object_array = [];
        while ($row = mysqli_fetch_array($result)) {
            $the_object_array[] = static::auto_instantiation($row);
        }

        return $the_object_array;
    }

    /**
     * @param $the_record
     *  With that function we manage get all keys  of that class
     *  and assign to the object automatic
     *
     * @return mixed
     */
    public static function auto_instantiation($the_record)
    {

        $calling_class = get_called_class();

        $the_object = new $calling_class;

//		$the_object = new static();
        foreach ($the_record as $key => $value) {
            if ($the_object->has_the_attribute($key)) {
                $the_object->key = $value;
            }
        }

        return $the_record;
    }

    /**
     * Find any query item you want by just passing object id
     * @param $id
     * @return object|stdClass|bool
     */
    public function find_by_id($id)
    {
        global $database;
        $query = $database->query("SELECT * FROM " . static::$db_table . " WHERE id =  '{$id}'");
        $res = $query->fetch_object(static::class);
        if (!empty($res)) {
            return $res;
        } else {
            return false;
        }

    }

    public function save()
    {
        return isset($this->id) ? $this->update() : $this->create();
    }

    public function update()
    {
        global $database;

        $properties = $this->cleanProperties();

        $properties_pairs = [];

        foreach ($properties as $key => $value) {
            $properties_pairs[] = "{$key}='{$value}'";


        }

        $query = "UPDATE " . static::$db_table . " SET " . implode(", ", $properties_pairs) . " WHERE id = $this->id";
        $res = $database->query($query);

        if ($res) {
            return $res;

        } else {
            return false;
        }

    }

    protected function cleanProperties()
    {
        global $database;

        $clean_properties = [];

        foreach ($this->properties() as $key => $values) {
            $clean_properties[$key] = $database->escape_string($values);
        }

        return $clean_properties;
    }

    /**
     * With that function we get all object table fields from $db_table_fields var
     * and assign all that properties to Array Variable
     * @return array
     */
    public function properties()
    {
//        return get_object_vars($this);

        $properties = [];
        foreach (static::$db_table_fields as $db_field) {
            if (property_exists($this, $db_field)) {
                $properties[$db_field] = $this->$db_field;
            }

        }
        return $properties;
    }

    public function create()
    {
        global $database;
        global $session;

        $properties = $this->properties();

        $sql = "INSERT INTO " . static::$db_table . "(" . implode(",", array_keys($properties)) . ")" . "values" . "('" . implode("','", array_values($properties)) . "') ";

        $res = $database->query($sql);

        if ($res) {
            $this->id = $database->the_insert_id();
            return TRUE;
        } else {
            return FALSE;
        }

    }

    public function delete()
    {
        global $database;


        $id = $database->escape_string($this->id);

        $query = "DELETE FROM " . static::$db_table . " WHERE id = '{$id}' LIMIT 1";

        $res = $database->query($query);

        if ($res) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $key
     * With that function we get all class properties and then
     * we check if all that variables exist by passing the $key name
     * if value exist the we return  it and assign all values to the object
     *
     * @return bool
     */
    private function has_the_attribute($key)
    {
        $object_properties = get_object_vars($this);
        $res = array_key_exists($key, $object_properties);

        return $res;
    }


}
