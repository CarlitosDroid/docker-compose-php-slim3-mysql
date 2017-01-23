<?php

class UserMapper extends Mapper
{
    public function selectUser() {
        $conn = $this->db;

        $response = array();
        $stmt = $conn->prepare("SELECT Name, LastName FROM USER");
        $stmt->execute();
        $data = array();
        if($stmt->execute()){
            $stmt->store_result();
            if($stmt->num_rows >0){
                $stmt->bind_result($Name, $LastName);

                while ($stmt->fetch()) {
                    $tmp = array();
                    $tmp["Name"] = $Name;
                    $tmp["LastName"] = $LastName;
                    array_push($data, $tmp);
                }

                $meta = array();
                $meta["status"] = "success";
                $meta["code"] = "200";
                $response["_meta"] = $meta;
                $response["user"] = $data;

            }else{
                $meta = array();
                $meta["status"] = "error";
                $meta["code"] = "100";
                $meta["message"] = "No existen Usuarios";
                $response["_meta"] = $meta;
            }
        }else{
            $meta = array();
            $meta["status"] = "error";
            $meta["code"] = "404";
            $meta["message"] = "Error Server";
            $response["_meta"] = $meta;
        }

        $stmt->close();
        return $response;
    }

    public function createUser($name, $lastName){
        $conn = $this->db;
        $response = array();

        if(strlen($name)>0 and strlen($lastName)>0){
            if(!$this->isUserExists($name, $lastName)){
                // insert query
                $stmt = $conn->prepare("INSERT INTO USER(Name, LastName) VALUES(?,?)");
                $stmt->bind_param("ss", $name, $lastName);
                // Check for successful insertion
                if ($stmt->execute() !== null) {
                    $_meta["status"]="SUCCESS";
                    $_meta["code"]="200";
                    // User successfully inserted
                    $response["_meta"] = $_meta;
                    $response["data"] = $this->selectUserByNames($name, $lastName);
                    $stmt->close();
                    return $response;
                }
            }else{
                $_meta["status"]="ERROR";
                $_meta["code"]="100";
                $_meta["message"]="User already exist in db";
                // User with same email already existed in the db
                $response["_meta"] = $_meta;
                $response["data"] = $this->selectUserByNames($name, $lastName);
                return $response;
            }
        }else{
            $_meta["status"]="ERROR";
            $_meta["code"]="100";
            $_meta["message"]="Empty params";
            // User with same email already existed in the db
            $response["_meta"] = $_meta;
            return $response;
        }
    }

    /**
     *  Checking for duplicate user by email address
     * @param String $name name of user
     * @param String $lastName lastname of user
     * @return boolean
     */
    public function isUserExists($name, $lastName){
        $conn = $this->db;
        $stmt = $conn->prepare("SELECT * FROM USER WHERE Name = ? AND LastName = ?");
        $stmt->bind_param("ss", $name, $lastName);
        $stmt->execute();
        $stmt->store_result();
        $num_rows = $stmt->num_rows;
        $stmt->close();
        return $num_rows>0;
    }

    /**
     *  Fetching user by name and lastname
     * @param String $name name of user
     * @param String $lastName lastname of user
     * @return array
     */
    public function selectUserByNames($name, $lastName){
        $conn = $this->db;
        $stmt = $conn->prepare("SELECT * FROM USER WHERE Name = ? AND LastName = ?");
        $stmt->bind_param("ss", $name, $lastName);

        if($stmt->execute()){
            $stmt->bind_result($userId, $Name, $LastName);
            $stmt->fetch();
            $user = array();
            $user["userId"] = $userId;
            $user["Name"] = $Name;
            $user["LastName"] = $LastName;
            $stmt->close();
            return $user;
        }else{
            return NULL;
        }
    }

}
