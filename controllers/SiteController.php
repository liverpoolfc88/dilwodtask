<?php

namespace app\controllers;

use app\models\Education;
use app\models\SignupForm;
use app\models\Skill;
use app\models\User;
use Yii;
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
        $model = User::find()->where(['status'=>10])->orderBy(['id'=>SORT_DESC])->all();
        return $this->render('index', [
            'model' => $model,
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
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


    public function actionSignup()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionProfile($id)
    {
        if ($id){
            $profile = User::find()->where(['id'=>$id])->one();
        }else{
            if (Yii::$app->user->isGuest) return $this->goHome(); //Agar ID kelmasa va mehmon bo`lsa
            else { // Agar ID kelmasa, lekin user_id bor bo`lsa
                $id = Yii::$app->user->identity->id;
            }
        }

//        echo "<pre>"; print_r($profile);exit;
        return $this->render('profile', [
            'model' => $profile,
        ]);

    }

    public function actionProfileUpdate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = User::find()->where(['id'=>Yii::$app->user->identity->id])->one();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['profile', 'id' => $model->id]);
        }

        return $this->render('profile_update', [
            'model' => $model,
        ]);
    }

    public function actionEducation()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new Education();

        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->identity->id;
            $model->save();
            return $this->redirect(['profile', 'id' => Yii::$app->user->identity->id]);
        }

        return $this->render('education', [
            'model' => $model,
        ]);
    }

    public function actionEducationUpdate($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = Education::find()->where(['user_id'=>Yii::$app->user->identity->id])->andWhere(['id'=>$id])->one();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['profile', 'id' => Yii::$app->user->identity->id]);
        }

        return $this->render('education_update', [
            'model' => $model,
        ]);
    }

    public function actionEducationRemove($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = Education::find()->where(['user_id'=>Yii::$app->user->identity->id])->andWhere(['id'=>$id])->one();
        if ($model->delete())
            return $this->redirect(['profile', 'id' => Yii::$app->user->identity->id]);
    }

    public function actionSkill()
    {
        $model = new Skill();

        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->identity->id;
            $model->save();
            return $this->redirect(['profile', 'id' => Yii::$app->user->identity->id]);
        }

        return $this->render('skill', [
            'model' => $model,
        ]);
    }

    public function actionSkillUpdate($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = Skill::find()->where(['user_id'=>Yii::$app->user->identity->id])->andWhere(['id'=>$id])->one();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['profile', 'id' => Yii::$app->user->identity->id]);
        }

        return $this->render('skill_update', [
            'model' => $model,
        ]);
    }

    public function actionSkillRemove($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = Skill::find()->where(['user_id'=>Yii::$app->user->identity->id])->andWhere(['id'=>$id])->one();
        if ($model->delete())
            return $this->redirect(['profile', 'id' => Yii::$app->user->identity->id]);
    }
}
