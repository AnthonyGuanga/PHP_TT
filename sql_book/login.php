<?php 

public function userExsiste($email){
    if($this->conn){
        try{
            $sql = "SELECT COUNT(*) FROM usuarios WHRE email = :email";
            $stmt = $this->conn->prepare($sql);

            $stmt->execute();
        }
    }
}
?>