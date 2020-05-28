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
    }

    /**
     * 
     * @return type $cards - array;
     * 
     * Returns array of cards.
     */
    public function getCards() {

        // Setting sql query
        $sql = "SELECT * FROM ?";

        // Prepare and execute SQL query
        $pdostmt = $this->dbh->prepare($sql);
        $pdostmt->bindParam(1, $this->tablename);
        $pdostmt->execute();

        // Get all records
        $cards = array();
        $i = 0;
        while ($row = $pdostmt->fetch(PDO::FETCH_ASSOC)) {
            $cards[$i]['id'] = $row['id'];
            $cards[$i]['original'] = $row['original'];
            $cards[$i]['translation'] = $row['translation'];
            $cards[$i]['comment'] = $row['comment'];
            
            $i++;
        }
        
        return $cards;
    }

    public static function rewriteCard($id){
        // Setting sql query
        $sql = "UPDATE ? SET original = ? , translation = ? , comment = ? , stack = ? "
                . "WHERE id = ?";

        // Prepare and execute SQL query
        $pdostmt = $this->dbh->prepare($sql);
        $pdostmt->bindParam(1, $this->tablename);
        $pdostmt->bindParam(2, $original);
        $pdostmt->bindParam(3, $translation);
        $pdostmt->bindParam(4, $comment);
        $pdostmt->bindParam(5, $stack);
        $pdostmt->bindParam(6, $id);
        $pdostmt->execute();
        
        return;
    }
    
    // Deletes a card to database
    public function deleteCard($id){
        // Setting sql query
        $sql = "DELETE FROM ? WHERE id = ?";

        // Prepare and execute SQL query
        $pdostmt = $this->dbh->prepare($sql);
        $pdostmt->bindParam(1, $this->tablename);
        $pdostmt->bindParam(2, $id);
        
        return $pdostmt->execute();
    }
    
    // Adds a card to database
    public function addCard($original, $translation, $comment, $stack){
        // Setting sql query
        $sql = "INSET INTO ? (original, translation, comment, stack) "
                . "VALUES (? , ? , ? , ?)";

        // Prepare and execute SQL query
        $pdostmt = $this->dbh->prepare($sql);
        $pdostmt->bindParam(1, $this->tablename);
        $pdostmt->bindParam(2, $original);
        $pdostmt->bindParam(3, $translation);
        $pdostmt->bindParam(4, $comment);
        $pdostmt->bindParam(5, $stack);
        $pdostmt->execute();
        
        return;
    }
    
    public function getLastCard(){
        // Setting sql query
        $sql = "SELECT * FROM ? ORDER BY id DESC LIMIT 1";
        
        // Prepare and execute SQL query
        $pdostmt = $this->dbh->prepare($sql);
        $pdostmt->bindParam(1, $this->tablename);
        
        $row = $pdostmt->fetch(PDO::FETCH_ASSOC);
        
        return row;
    }
    
    // Returns an one card by id
    public function getOneCard($id){
        // Setting sql query
        $sql = "SELECT * FROM ? WHERE id = ? ";
        
        // Prepare and execute SQL query
        $pdostmt = $this->dbh->prepare($sql);
        $pdostmt->bindParam(1, $this->tablename);
        $pdostmt->bindParam(2, $id);
        
        $row = $pdostmt->fetch(PDO::FETCH_ASSOC);
        
        return row;
    }
}
