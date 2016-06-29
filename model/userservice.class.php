<?php

class UserService {

    function getAllUsers() {
        try {
            $db = DB::getConnection();
            $st = $db->prepare('SELECT * FROM user');
            $st->execute();
        } catch (PDOException $e) {
            exit('PDO error ' . $e->getMessage());
        }

        $arr = array();
        while ($row = $st->fetch()) {
            $arr[] = new User($row['id'], $row['username'], $row['email'], $row['first_name'], $row['last_name'], $row['password'], $row['is_admin'], $row['blog_name']);
        }

        return $arr;
    }
    
    function getUserById($userId) {
        try {
            $db = DB::getConnection();
            $st = $db->prepare('SELECT * FROM user where id=:id LIMIT 1');
            $st->execute(array('id' => $userId));
            
            $row = $st->fetch();
        } catch (PDOException $e) {
            exit('PDO error ' . $e->getMessage());
        }
        
        return new User($row['id'], $row['username'], $row['email'], $row['first_name'], $row['last_name'], $row['password'], $row['is_admin'], $row['blog_name']);
    }
    
    function loginUser( $username, $password) {
        try {
            $db = DB::getConnection();
            $st = $db->prepare('SELECT * FROM user WHERE username=:username');
            $st->execute(array('username' => $username));
            
            $row = $st->fetch();
            
            if( $row === false) {
                throw new Exception('Username ne postoji');
            }
            
            $hash = $row[ 'password'];
            // Da li je password dobar?
            if( !password_verify( $password, $hash ) ) {
               throw new Exception('Neispravan password');
            }
            
            $user = new User($row['id'], $row['username'], $row['email'], $row['first_name'], $row['last_name'], $row['password'], $row['is_admin'], $row['blog_name']);

            return $user;
            
        } catch (PDOException $e) {
            echo( 'Greška:' . $e->getMessage() );
            return false;
        }
    }
    
    function registerUser($username, $password, $email, $first_name, $last_name, $blog_name){
        try {
            $db = DB::getConnection();
            $st = $db->prepare('SELECT * FROM user WHERE username=:username');
            $st->execute(array('username' => $username));
        }
        catch (PDOException $e) {
            echo( 'Greška:' . $e->getMessage() );
            return false;
        }             
            
        if( $st->rowCount() > 0 ) {
            throw new Exception('Taj korisnik već postoji.');
        }
        else{
            // Stvarno nema tog korisnika. Dodaj ga u bazu.
            try
            {
		// Prvo pripremi insert naredbu.
		$st = $db->prepare( 'INSERT INTO user (username, email, first_name, last_name, password, is_admin, blog_name) '
                            . 'VALUES (:username, :email, :first_name, :last_name, :hash, :is_admin, :blog_name)' );

		// Napravi hash od passworda kojeg je unio user.
		$hash = password_hash( $_POST["password"], PASSWORD_DEFAULT );

		// Izvrši sad tu insert naredbu. Uočite da u bazu stavljamo hash, a ne $_POST["password"]!
		$st->execute( array( 'username' => $username, 'email' => $email,
                    'first_name' => $first_name, 'last_name' => $last_name, 'hash' => $hash,
                    'is_admin' => 0, 'blog_name' => $blog_name ) );
            }
            catch (PDOException $e) {
                echo( 'Greška:' . $e->getMessage() );
                return false;
            }   
        }
        return;  
    }

}

?>