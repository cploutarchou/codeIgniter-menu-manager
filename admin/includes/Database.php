<?php
declare( strict_types=1 );

require_once "init.php";

class Database
{
    /**
     * @var
     */
    public $connection;

    function __construct()
    {
        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->connection->connect_errno) {
            die('database connection failed' . $this->connection->connect_error);
        }
    }

    /**
     * @param $query
     *  With that Function we just pass our query and to get all query results need to
     *  create a foreach loop
     * @return array|bool
     */
    public function find_any_query($query)
    {
        $result = [];
        $query_results = $this->query($query);
        if ($query_results->num_rows) {
            while ($res = $query_results->fetch_array()) {
                $result[] = $res;
            }
            return $result;
        } else {
            return false;
        }
    }

    public function query($query)
    {
        $result = $this->connection->query($query);
        $this->confirm_query($result);

        return $result;
    }

    private function confirm_query($result)
    {
        if (!$result) {
            die("Query Failed " . "<b>" . $this->connection->error . "</b>");
        }
    }

    /**
     * @param $query
     * With that function we pass our query then function get all value using while method for each result
     * and get data using fetch_object php method then return or the results and get all data using
     * foreach loop
     *
     * @return array|bool
     */
    public function find_any_query_oop($query)
    {
        $result = [];
        $query_results = $this->query($query);
        if ($query_results->num_rows > 0) {
            while ($res = $query_results->fetch_object()) {
                $result[] = $res;
            }

            return $result;
        } else {
            return false;
        }
    }

    public function escape_string($string)
    {
        $escaped_string = $this->connection->real_escape_string(strval($string));

        return $escaped_string;
    }

    /**
     * That function return the last insert id
     *
     * @return int|string
     */
    public function the_insert_id()
    {
        return mysqli_insert_id($this->connection);
    }
}

$database = new database();
