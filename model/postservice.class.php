<?php

class PostService {

    function getPostsByUser($userId) {
        try {
            $db = DB::getConnection();
            $st = $db->prepare('SELECT * FROM post where user_id=:user_id');
            $st->execute(array('user_id' => $userId));
        } catch (PDOException $e) {
            exit('PDO error ' . $e->getMessage());
        }

        $arr = array();
        while ($row = $st->fetch()) {
            $arr[] = new Post($row['id'], $row['title'], $row['text'], $row['created'], $row['user_id']);
        }

        return $arr;
    }

    function getPostById($postId) {
        try {
            $db = DB::getConnection();
            $st = $db->prepare('SELECT * FROM post where id=:id LIMIT 1');
            $st->execute(array('id' => $postId));

            $row = $st->fetch();
        } catch (PDOException $e) {
            exit('PDO error ' . $e->getMessage());
        }

        return new Post($row['id'], $row['title'], $row['text'], $row['created'], $row['user_id']);
    }

    function insertPost($title, $text, $change, $pid) {
        try {
            $db = DB::getConnection();
            if ($change == true) {
                $st = $db->prepare('UPDATE post SET title=:title, text=:text 
                        WHERE id=:id');
                // Izvrši sad tu naredbu. 
                $st->execute(array('id' => $pid, 'title' => $title, 'text' => $text));
            } else {
                // Prvo pripremi insert naredbu.
                $st = $db->prepare('INSERT INTO post (title, text, user_id) '
                        . 'VALUES (:title, :text, :user_id)');
                // Izvrši sad tu insert naredbu. 
                $st->execute(array('title' => $title, 'text' => $text, 'user_id' => $_SESSION['user']->id));
            }
        } catch (PDOException $e) {
            echo( 'Greška:' . $e->getMessage() );
            exit;
        }
    }

    // briše post s danim id-om iz baze
    function deletePost($postId) {
        try {
            $db = DB::getConnection();

            // Prvo pripremi delete naredbu.
            $st = $db->prepare('DELETE FROM post '
                    . 'WHERE id LIKE :id');

            // Izvrši sad tu delete naredbu. 
            $st->execute(array('id' => $postId));
        } catch (PDOException $e) {
            echo( 'Greška:' . $e->getMessage() );
            return false;
        }
    }

}
?>

