<?php
		error_reporting(E_ALL);
		ini_set('display_errors', 1);

	class HerokuPostgresDatabase
	{

	private $connection;
    function __construct()
    {
        $this->open_connection();
    }
    public function open_connection()
    {
    	extract(parse_url($_ENV["DATABASE_URL"]));
        $this->connection = pg_connect("user=$user password=$pass host=$host dbname=" . substr($path, 1));

 
       # <- you may want to add sslmode=require there too
    }// fun open_connection() ends

      public function close_connection()
    {
        if (isset($this->connection)) {
            pg_close($this->connection);
            unset($this->connection);
        }
    }

    public function query($sql)
    {
        $result = pg_query($this->connection, $sql);
        $this->confirm_query($result);
        return $result;
    }

     private function confirm_query($result)
    {
        if (!$result) {
            die("\nDatabase query failed.");
        }
    }

     public function escape_value($string)
    {
        $escaped_string = pg_escape_string($this->connection, $string);
        return $escaped_string;
    }

     public function fetch_array($result_set)
    {
        return pg_fetch_array($result_set);
    }
   

	}// class HerokuPostgresDatabase ends

		// $herokupostgrsdatabse = new HerokuPostgresDatabase();
		//for extra referebce or to use popular term "db"

//$db =& $database;

?>