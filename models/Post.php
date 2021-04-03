<?php

namespace app\models;

use yii\db\ActiveRecord;

class Post extends ActiveRecord
{
    /**
     * @inheritdoc
     */

    public static function tableName()
    {
        return 'posts';
    }

    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            ['title', 'string', 'min' => 10, 'max' => 35],
        ];
    }

    public function isUserPost($post_id, $user_id)
    {
        $post = Post::findOne($post_id);
        if ($post->author_id != $user_id){
            return false;
        }
        return true;
    }

    public function createPost($request_data)
    {
        $this->title = $request_data['title'];
        $this->description = $request_data['description'];
        $this->author_id = \Yii::$app->user->identity->id;
        $this->create_at = date('Y-m-d h:i:s');
        return $this->save();
    }

    /* Relations */

    /**
     * @return \yii\db\ActiveQuery
     */

    public function getAuthor()
    {
        return $this->hasMany(User::className(), ['id' => 'author_id']);
    }
}