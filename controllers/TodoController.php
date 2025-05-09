<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\Todo;
use app\models\Category;

class TodoController extends Controller
{
    public function actionIndex()
    {
        $categoryId = Yii::$app->request->get('category_id');
        $query = Todo::find()->with('category');

        if ($categoryId) {
            $query->andWhere(['category_id' => $categoryId]);
        }

        $todos = $query->orderBy(['timestamp' => SORT_DESC])->all();
        $categories = Category::find()->all();

        return $this->render('index', [
            'todos' => $todos,
            'categories' => $categories,
            'selectedCategory' => $categoryId,
        ]);
    }

    public function actionCreate()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new Todo();
        $model->name = Yii::$app->request->post('name');
        $model->category_id = Yii::$app->request->post('category_id');
        $model->timestamp = date('Y-m-d H:i:s');
        $model->status = 0; // incomplete
        if ($model->save()) {
            return [
                'success' => true,
                'todo' => [
                    'id' => $model->id,
                    'name' => $model->name,
                    'category' => $model->category->name,
                    'timestamp' => date('d M Y', strtotime($model->timestamp)),
                    'status' => $model->status
                ]
            ];
        }
        return ['success' => false];
    }

    public function actionDelete($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = Todo::findOne($id);
        if ($model && $model->delete()) {
            return ['success' => true];
        }
        return ['success' => false];
    }

    public function actionToggleStatus($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = Todo::findOne($id);
        if ($model) {
            $model->status = $model->status ? 0 : 1;
            if ($model->save()) {
                return ['success' => true, 'status' => $model->status];
            }
        }
        return ['success' => false];
    }

    public function actionUpdate($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = Todo::findOne($id);
        if ($model) {
            $model->name = Yii::$app->request->post('name');
            if ($model->save()) {
                return ['success' => true, 'name' => $model->name];
            }
        }
        return ['success' => false];
    }
}
