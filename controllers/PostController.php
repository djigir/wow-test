<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Post;

class PostController extends Controller
{

    public function actionEdit($id)
    {
        /* create*/
        if ($id == 'create') {
            $post_model = new Post();


            if (!empty(\Yii::$app->request->bodyParams)) {
                $post_model->createPost(\Yii::$app->request->bodyParams['Post']);
                return $this->redirect('/');
            }

            return $this->render('edit', ['model' => $post_model, 'post' => $id]);
        }

        /* edit */
        if ($id != 'create') {
            $post = Post::findOne($id);

            if (!empty(\Yii::$app->request->bodyParams)) {
                $request_data = \Yii::$app->request->bodyParams['Post'];
                /* if change title or description update this fields */
                if ($request_data['title'] != $post->title || $request_data['description'] != $post->description) {
                    $post->title = $request_data['title'];
                    $post->description = $request_data['description'];
                    $post->save();
                    return $this->redirect(['post/show', 'id' => $id]);
                }
            }
        }

        return $this->render('edit', ['model' => new Post(), 'post' => $post]);
    }

    /**
     * @param $id
     * @return string
     */
    public function actionShow($id)
    {
        $post = Post::findOne($id);
        return $this->render('show', ['post' => $post]);
    }

    public function actionDelete($id)
    {
        $post = Post::findOne($id);
        if ($post->author_id == \Yii::$app->user->identity->id) {
            $post->delete();
        }
        return $this->redirect('/');
    }
}
