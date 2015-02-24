<?php
/* this class holds a conection to cliente incognito DB*/
  class CIConection
  {
    private $PDOInstance;
    private $host = "localhost";
    private $user = "";
    private $password = "";
    private $database = "";

    public function __construct()
    {
      try
      {
        $this->PDOInstance= new PDO(sprintf("mysql:host=%s;dbname=%s",$this->host ,$this->database), $this->user, $this->password);
      }
      catch(PDOException $e)
      {
        echo $e->getMessage();
      }
    }

    public function getConection() {
      return $this->PDOInstance;
    }
  
    public function closeConection()
    {
      $this->PDOInstance = null;
    }
  }
?>
