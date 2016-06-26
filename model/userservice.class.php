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

    function loginUser( $username, $password) {
        try {
            $db = DB::getConnection();
            $st = $db->prepare('SELECT * FROM user WHERE username=:username');
            $st->execute(array('username' => $username));
            
            $row = $st->fetch(PDO::FETCH_ASSOC);
            
            if( $row === false) {
                throw new Exception('Username ne postoji');
            }
            
            $hash = $row[ 'password'];
            // Da li je password dobar?
            if( !password_verify( $password, $hash ) ) {
               // throw new Exception('Neispravan password');
            }
            
            $user = new User($row['id'], $row['username'], $row['email'], $row['first_name'], $row['last_name'], $row['password'], $row['is_admin'], $row['blog_name']);

            return $user;
            
        } catch (PDOException $e) {
            echo( 'Greška:' . $e->getMessage() );
            return false;
        }

    }

}

?>