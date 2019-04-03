<?php
/**
 * Created by PhpStorm.
 * User: kelba_000
 * Date: 04/03/2019
 * Time: 18:39
 */

namespace app\models;


use Yii;
use yii\base\Model;

class CommentsForm extends Model
{
    public $comment;

    public function rules()
    {
        return [
            [['comment'], 'required'],
            [['comment'], 'string', 'length' => [3,250]]
        ];
    }

    public function saveComment($article_id)
    {
        $comment = new Comment;
        $comment->text = $this->comment;
        $comment->user_id = Yii::$app->user->id;
        $comment->article_id = $article_id;
        $comment->status = 0;
        $comment->date = date('Y-m-d');
        return $comment->save();
    }
}