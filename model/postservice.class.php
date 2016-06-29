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
    
    function getPostById($postId){
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

}

?>

