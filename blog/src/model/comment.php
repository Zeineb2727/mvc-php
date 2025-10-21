<?php
//src/model/comment.php
function getComments($post)
{
    $database = commentDbConnect();
    $statement = $database->prepare(
        "SELECTid,author,comment,
    DATE_FORMAT(comment_date, '%d/%m/%Y à%Hh%imin%ss')
    ASfrench_creation_dateFROM commentsWHERE post_id= ?
    ORDERBY comment_date DESC"
    );
    $statement->execute([$post]);
    $comments = [];
    while (($row = $statement->fetch())) {
        $comment = [
            'author' => $row['author'],
            'french_creation_date' => $row['french_creation_date'],
            'comment' => $row['comment'],
        ];
        $comments[] = $comment;
    }
    return $comments;
}

function createComment($post, $author, $comment)
{
    $database = commentDbConnect();
    $statement = $database->prepare(
        'INSERT INTOcomments(post_id, author,comment, comment_date) VALUES(?, ?,?,NOW())'
    );
    $affectedLines = $statement->execute([$post, $author, $comment]);
    return ($affectedLines > 0);
}

function commentDbConnect()
{
    try {
        $database = new PDO(
            'mysql:host=localhost;dbname=blog;charset=utf8',
            'root',
            'root'
        );
        return $database;
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}