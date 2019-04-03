<?php

namespace app\controllers;

use app\models\Article;
use app\models\Category;
use app\models\CommentsForm;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $data = Article::getAll(1);
        $populars = Article::getPopular();
        $recent = Article::getRecent();
        $category = Category::getAll();

        return $this->render('index', [
            'articles' => $data['articles'],
            'pages' => $data['pages'],
            'populars' => $populars,
            'recent' => $recent,
            'category' => $category
        ]);
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionView($id)
    {
        $article = Article::findOne($id);
        $populars = Article::getPopular();
        $recent = Article::getRecent();
        $category = Category::getAll();
        $comments = $article->getArticleComments();
        $commentsForm = new CommentsForm();

        $article->viewedCounter();

        return $this->render('single', [
            'article' => $article,
            'populars' => $populars,
            'recent' => $recent,
            'category' => $category,
            'comments' => $comments,
            'commentsForm' => $commentsForm
        ]);
    }

    public function actionCategory($id)
    {
        $data = Category::getArticlesByCategory($id);
        $populars = Article::getPopular();
        $recent = Article::getRecent();
        $category = Category::getAll();

        return $this->render('category', [
            'pages' => $data['pages'],
            'articles' => $data['articles'],
            'populars' => $populars,
            'recent' => $recent,
            'category' => $category
        ]);
    }

    public function actionComment($id)
    {
        $model = new CommentsForm();

        if (Yii::$app->request->isPost)
        {
            $model->load(Yii::$app->request->post());
            if ($model->saveComment($id))
            {
                Yii::$app->getSession()->setFlash('comment', 'Yes, you comment add, and will be added soon!');
                return $this->redirect(['site/view', 'id' => $id]);
            }
        }
    }
}
