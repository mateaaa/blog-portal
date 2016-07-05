<?php

class CommentService {

    // vraća sve komentare od posta s danim id-em
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
            exit;
        }
    }

    // brisanje određenog komentara
    function deleteComment($commentId) {
        try {
            $db = DB::getConnection();

            // Prvo pripremi delete naredbu.
            $st = $db->prepare('DELETE FROM comment '
                    . 'WHERE id LIKE :id');

            // Izvrši sad tu delete naredbu. 
            $st->execute(array('id' => $commentId));
        } catch (PDOException $e) {
            echo( 'Greška:' . $e->getMessage() );
            return false;
        }
    }

    // brisanje svih komentara na određeni post
    function deleteComments($postId) {
        try {
            $db = DB::getConnection();

            // Prvo pripremi delete naredbu.
            $st = $db->prepare('DELETE FROM comment '
                    . 'WHERE post_id LIKE :post_id');

            // Izvrši sad tu delete naredbu. 
            $st->execute(array('post_id' => $postId));
        } catch (PDOException $e) {
            echo( 'Greška:' . $e->getMessage() );
            return false;
        }
    }

    // izmjena određenog komentara
    function updateComment($commentText, $commentId) {
        try {
            $db = DB::getConnection();

            // Prvo pripremi naredbu.
            $st = $db->prepare('UPDATE comment '
                    . 'SET text = :text WHERE id = :id' );

            // Izvrši sad tu delete naredbu. 
            $st->execute(array('id' => $commentId, 'text' => $commentText));
        } catch (PDOException $e) {
            echo( 'Greška:' . $e->getMessage() );
            return false;
        }
    }

}
?>

