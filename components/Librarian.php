<?php

/**
 * Description of Librarian
 *
 */
class Librarian {
    
    // Requires a database descriptor and the name of the table where user cards are stored
    public function __construct($dbh, $tablename) {
        $this->dbh = $dbh;
        $this->tablename = $tablename;
        $this->login = $_SESSION['login'];
    }

    /**
     * 
     * @return type $cards - array;
     * 
     * Returns array of cards.
     */
    public function getCards() {

        // Setting sql query
        $sql = "SELECT * FROM $this->tablename WHERE login = ?";

        // Prepare and execute SQL query
        $pdostmt = $this->dbh->prepare($sql);
        $pdostmt->bindParam(1, $this->login);
        $pdostmt->execute();

        // Get all records
        $cards = array();
        $i = 0;
        while ($row = $pdostmt->fetch(PDO::FETCH_ASSOC)) {
            $cards[$i]['id'] = $row['id'];
            $cards[$i]['original'] = $row['original'];
            $cards[$i]['originalComment'] = $row['original_comment'];
            $cards[$i]['translation'] = $row['translation'];
            $cards[$i]['translationComment'] = $row['translation_comment'];
            $cards[$i]['stack'] = $row['stack'];
            
            $i++;
        }
        
        return $cards;
    }

    public static function rewriteCard($id){
        // Setting sql query
        $sql = "UPDATE $this->tablename SET original = ? , originalComment = ?, "
                . "translation = ? , translationComment = ? , stack = ? "
                . "WHERE id = ? AND login = ?";

        // Prepare and execute SQL query
        $pdostmt = $this->dbh->prepare($sql);
        $pdostmt->bindParam(1, $original);
        $pdostmt->bindParam(2, $originalComment);
        $pdostmt->bindParam(3, $translation);
        $pdostmt->bindParam(4, $translationComment);
        $pdostmt->bindParam(5, $stack);
        $pdostmt->bindParam(6, $id);
        $pdostmt->bindParam(7, $this->login);
        $pdostmt->execute();
        
        return;
    }
    
    // Deletes a card to database
    public function deleteCard($id){
        // Setting sql query
        $sql = "DELETE FROM $this->tablename WHERE id = ? AND login = ?";

        // Prepare and execute SQL query
        $pdostmt = $this->dbh->prepare($sql);
        $pdostmt->bindParam(1, $id);
        $pdostmt->bindParam(2, $this->login);
        
        return $pdostmt->execute();
    }
    
    // Adds a card to database
    public function addCard($original, $originalComment, $translation, $translationComment, $stack){
        // Setting sql query
        $sql = "INSET INTO $this->tablename (original, originalComment, translation, translationComment, stack, login) "
                . "VALUES (? , ? , ? , ? , ? , ? )";

        // Prepare and execute SQL query
        $pdostmt = $this->dbh->prepare($sql);
        $pdostmt->bindParam(1, $original);
        $pdostmt->bindParam(2, $originalComment);
        $pdostmt->bindParam(3, $translation);
        $pdostmt->bindParam(4, $translationComment);
        $pdostmt->bindParam(5, $stack);
        $pdostmt->bindParam(6, $this->login);
        $pdostmt->execute();
        
        return;
    }
    
    public function getLastCard(){
        // Setting sql query
        $sql = "SELECT * FROM $this->tablename WHERE login = ? ORDER BY id DESC LIMIT 1";
        
        // Prepare and execute SQL query
        $pdostmt = $this->dbh->prepare($sql);
        $pdostmt->bindParam(1, $this->login);
        
        $row = $pdostmt->fetch(PDO::FETCH_ASSOC);
        
        return row;
    }
    
    // Returns an one card by id
    public function getOneCard($id){
        // Setting sql query
        $sql = "SELECT * FROM $this->tablename WHERE id = ? AND login = ?";
        
        // Prepare and execute SQL query
        $pdostmt = $this->dbh->prepare($sql);
        $pdostmt->bindParam(1, $id);
        $pdostmt->bindParam(2, $this->login);
        
        $row = $pdostmt->fetch(PDO::FETCH_ASSOC);
        
        return row;
    }
}
