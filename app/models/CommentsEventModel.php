<?php
/**
 * Created by PhpStorm.
 * User: loic
 * Date: 10/01/15
 * Time: 16:35
 */

namespace app\models;

use SwagFramework\Database\DatabaseProvider;
use SwagFramework\mvc\Model;

class CommentsEventModel extends Model
{

    /**
     * Return all comment for all event.
     * @return array
     */
    public function getAllCommentsEvent()
    {
        $sql = "SELECT id, name,text,username FROM user,comment_event,comment,event WHERE " .
            "comment_event.event = event.id AND comment_event.id = comment.id AND user.id = comment.user;";

        return DatabaseProvider::connection()->execute($sql, null);
    }


    /**
     * Return all comment for the id event.
     * @param $id
     * @return array
     */
    public function getCommentEvent($id)
    {
        $sql = "SELECT name,text,username FROM user,comment_event,comment,event WHERE " .
            "event.id = ? AND comment_event.id = comment.id AND user.id = comment.user;";

        return DatabaseProvider::connection()->execute($sql, $id);

    }

    /**
     * Update comment on event
     * @param $params
     * @throws \SwagFramework\Exceptions\DatabaseConfigurationNotLoadedException
     */
    public function updateCommentEvent($params)
    {
        try {
            DatabaseProvider::connection()->beginTransaction();

            $sqlComm = "UPDATE comments  SET contents = ? WHERE id = ? ;";
            DatabaseProvider::connection()->execute($sqlComm, $params['content'], $params['idcomment']);

            DatabaseProvider::connection()->commit();

        } catch (\Exception $e) {
            DatabaseProvider::connection()->rollBack();
        }

    }

    /**
     * Insert in DB a comment for an event.
     * @param $params
     * @throws \SwagFramework\Exceptions\DatabaseConfigurationNotLoadedException
     */
    public function insertCommentEvent($params)
    {
        try {
            DatabaseProvider::connection()->beginTransaction();

            $sqlComm = "INSERT INTO comments ('user','contents') VALUES ? , ? ;";
            DatabaseProvider::connection()->execute($sqlComm, $params['iduser'], $params['contents']);

            $tmp = $this->getIdComment();
            $sqlComm = "INSERT INTO comment_event ('id','event') VALUES ? , ? ;";
            DatabaseProvider::connection()->execute($sqlComm, $tmp, $params['idevent']);

            DatabaseProvider::connection()->commit();

        } catch (\Exception $e) {
            DatabaseProvider::connection()->rollBack();
        }

    }

    /**
     * Return id of last comment
     * @return mixed
     * @throws \SwagFramework\Exceptions\DatabaseConfigurationNotLoadedException
     */
    private function getIdComment()
    {
        $sql = "SELECT MAX(id) FROM comment";

        return DatabaseProvider::connection()->execute($sql, null)[0];
    }

    /**
     *  Delete a comment.
     * @param $id of comment
     * @return bool
     * @throws \SwagFramework\Exceptions\DatabaseConfigurationNotLoadedException
     */
    public function deleteCommentEvent($id)
    {
        try {
            DatabaseProvider::connection()->beginTransaction();
            $sql = "DELETE FROM comment_event WHERE id = ? ";

            DatabaseProvider::connection()->execute($sql, $id);

            DatabaseProvider::connection()->commit();

        } catch (\Exception $e) {
            DatabaseProvider::connection()->rollBack();
        }

        return true;
    }
} 