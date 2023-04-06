<?php

include_once("./dbConnection.php");

class userDao{
    
    public function getAllUsers($conn){
        $sql = "SELECT * FROM users";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        $arrayResults = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $array = array(
                    "user" => $row['user'],
                    "name" => $row['name'],
                    "email" => $row['email'],
                );
                array_push($arrayResults, $array);
            }
        }
        $stmt->close();
        return $arrayResults;
    }

    public function login(User $user, $conn){
        
    }
}

 