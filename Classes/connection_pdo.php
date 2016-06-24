 <?php
date_default_timezone_set("Asia/Bangkok");
class DB{
    private static $_instance = null;
    private $host      = "localhost";
    private $user      = "root";
    private $pass      = "";
    private $dbname    = "testdb";
    private $dbh;
    private $error;
    private $stmt;
    private $btn;

    public function __construct()
    {
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        $options = array(
            PDO::ATTR_PERSISTENT    => true,
            PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
        );
        try{
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
            $this->dbh->exec("set names utf8");
        }
        catch(PDOException $e){
            $this->error = $e->getMessage();
        }
    }

     public function query($query){
        $this->stmt = $this->dbh->prepare($query);
     }

    public function bind($param, $value, $type = null){
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
      $this->stmt->bindValue($param, $value, $type);
    }

    public function execute(){
        return $this->stmt->execute();
    }
	 

    public function fetch(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function fetchColumn(){
       $this->execute();
       return $this->stmt->fetchColumn();
    }
    public function fetchNum(){
       $this->execute();
       return $this->stmt->fetch(PDO::FETCH_NUM);
    }

    public function single(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function rowCount(){
      $this->execute();
      return $this->stmt->rowCount();
    }
    public function maxid($table, $fileds){
        $sql = $this->query("SELECT MAX($fileds) AS max_id FROM $table");
        return $sql;
    }
  public function insert($table, $fileds){
    $filed =  '';
    $values =  '';
    $x = 0;
    foreach ($fileds as $key => $value) {
       $filed .= $key;
       $values .= $value;
       if($x < count($fileds) -1){
        $filed .= ',';
        $values .= ',';
      }
         $x++;
    }
        $sql = $this->query("INSERT INTO $table ($filed) VALUES ({$values})");
        return $sql;
  }
  public function show_btn($status){
       if(empty($status)){
            $this->btn = "NO Status";
       }else{
           switch ($status) {
               case 'P':
                   $this->btn = "primary";
                   break;
               case 'Y':
                    $this->btn = "success";
                   break;
              case 'N':
                    $this->btn = "danger";
                   break;
               default:
                  $this->btn = "default";
                   break;
           }
       }
       return $this->btn;
  }

}
?>