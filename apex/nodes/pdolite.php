<?php

class PreparedStatement {
    private $connection;
    private $statement;
    private $query;
    private $parameters;
    
    /**
     * Constructor to initialize the database connection
     * 
     * @param mysqli $connection Database connection instance
     */
    public function __construct(mysqli $connection) {
        $this->connection = $connection;
        $this->parameters = [];
    }
    
    /**
     * Sets the SQL query for the prepared statement
     * 
     * @param string $query SQL query with placeholders
     * @return PreparedStatement
     * @throws Exception If query is empty
     */
    public function Query(string $query): PreparedStatement {
        if (empty($query)) {
            // throw new Exception("Query cannot be empty");
            echo "";
        }
        
        $this->query = $query;
        $this->statement = $this->connection->prepare($query);
        
        if (!$this->statement) {
            // throw new Exception("Failed to prepare statement: " . $this->connection->error);
            echo "";

        }
        
        return $this;
    }
    
    /**
     * Sets the parameters for the prepared statement
     * 
     * @param string $types Parameter types (i: integer, s: string, d: double, b: blob)
     * @param array $params Array of parameter values
     * @return PreparedStatement
     * @throws Exception If parameters are invalid
     */
    public function Object(string $types, array $params): PreparedStatement {
        if (strlen($types) !== count($params)) {
            // throw new Exception("Number of types must match number of parameters");
            echo "";
        }
        
        $this->parameters = [$types];
        foreach ($params as $param) {
            $this->parameters[] = $param;
        }
        
        return $this;
    }
    
    /**
     * Executes the prepared statement
     * 
     * @return mixed Statement execution result
     * @throws Exception If statement or parameters are not set
     */
    public function Statement() {
        if (!$this->statement) {
            // throw new Exception("Statement not prepared. Call SetStatementQuery first.");
            echo "";

        }
        
        if (!empty($this->parameters)) {
            $this->statement->bind_param(...$this->parameters);
        }
        
        if (!$this->statement->execute()) {
            // throw new Exception("Failed to execute statement: " . $this->statement->error);
            echo "";
        }
        
        return $this->statement->get_result();
    }
    
    /**
     * Closes the prepared statement
     */
    public function __destruct() {
        if ($this->statement) {
            $this->statement->close();
        }
    }
}

?>