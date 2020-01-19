<?php
declare( strict_types=1 );

class Comment extends Db_object
{

    /**
     * var string
     */
    protected static $db_table = "comments";
    /**
     * var array
     */
    protected static $db_table_fields = ['id', 'photo_id', 'author', 'body', 'email'];
    /**
     * @var string
     */
    public $author, $body, $email;
    /**
     * @var int
     */
    public $id, $photo_id;

    /**
     * @param $photo_id
     * @param string $author
     * @param string $email
     * @param string $body
     * @return bool|Comment
     */
    public static function add_comment($photo_id, $author, $email, $body)
    {
        if (!empty($photo_id) && !empty($author) && !empty($body) && !empty($email)) {

            $comment = new Comment();
            $comment->photo_id = (int)$photo_id;
            $comment->author = $author;
            $comment->email = $email;
            $comment->body = $body;

            return $comment;

        } else {
            return false;
        }

    }

    public static function get_comments_by_photo_id($photo_id = 0)
    {
        global $database;

        $escaped_string = $database->escape_string($photo_id);

        $query = "SELECT * FROM comments WHERE photo_id = $escaped_string ORDER BY photo_id ";
        $res = self::find_by_query_oop($query);
        if ($res) {
            return $res;
        } else {
            return false;

        }

    }

}

$comment = new Comment();




















