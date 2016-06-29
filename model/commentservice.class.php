<?php

class CommentService {

    function getCommentsOnPost($postId) {
        try {
            $db = DB::getConnection();
            $st = $db->prepare(
                    'SELECT c.*, u.username FROM comment as c
                    LEFT JOIN user as u
                    ON c.user_id = u.id where post_id=:post_id
                    ORDER BY c.created DESC');

            $st->execute(array('post_id' => $postId));
        } catch (PDOException $e) {
            exit('PDO error ' . $e->getMessage());
        }

        $arr = array();
        while ($row = $st->fetch()) {
            $comment = new Comment($row['id'], $row['text'], $row['post_id'], $row['user_id'], $row['created']);
            $comment->username = $row['username'];
            $arr[] = $comment;
        }

        return $arr;
    }

    function insertComment($text, $post_id) {
        try {
            $db = DB::getConnection();

            // Prvo pripremi insert naredbu.
            $st = $db->prepare('INSERT INTO comment (text, post_id, user_id) '
                    . 'VALUES (:text, :post_id, :user_id)');

            // Izvrši sad tu insert naredbu. 
            $st->execute(array('text' => $text, 'post_id' => $post_id, 'user_id' => $_SESSION['user']->id));
        } catch (PDOException $e) {
            echo( 'Greška:' . $e->getMessage() );
            return false;
        }
    }

}
?>

