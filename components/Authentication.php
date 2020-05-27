<?php

/**
 * Authentication class
 * 
 * Requires a database handler, login, password to static method check()
 * 
 * SQL parameters by default:
 * tablename: "authentication"
 * columns: "login", "password"
 * 
 * Checks the hash from the js client and the hash in the database.
 * 
 * Returns "denied" or "allowed" depending on the result of the check.
 * 
 */
class Authentication {

    // Checks the hash from the js client and the hash in the database.
    public static function check($dbh, $login, $password){
        
        // Setting sql query
        $sql = "SELECT * FROM authentication WHERE login = ?";
        
        // Prepare and execute SQL query
        $pdostmt = $dbh->prepare($sql);
        $pdostmt->bindParam(1, $login);        
        $pdostmt->execute();
        
        // Get required record
        $row = $pdostmt->fetch(PDO::FETCH_ASSOC);
        
        // If the record does not exist
        if ($row = FALSE) {
            return "denied";
        }
        
        // If the password record does not exist
        $hash = $row['password'] ? : FALSE;
        
        // If all OK
        if (!empty($hash) AND password_verify($password, $hash)){
            return "allowed";
        }
        
        // Default
        return "denied";
    }
}
