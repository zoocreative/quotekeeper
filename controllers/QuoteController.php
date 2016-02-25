<?php
namespace mightyzoo\quotekeeper\controllers;

use app\components\FlashAlert;
use app\components\ZController;
use app\modules\quotes\models\Quote;
use yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class QuoteController extends ZController
{

    public $layout = '//inner.haml';

    /**
     * Controller behaviours
     * 
     * @return behaviour methods
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'create' => ['post'],
                    'update' => ['patch','put'],
                    'delete' => ['delete'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];
    }

    /**
     * Default actions
     * 
     * @return view
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionToast()
    {
        echo "Toast";
    }

    /**
     * View all available quotes / testimonials
     * 
     * @return string $view
     */
    public function actionIndex()
    {
        $pageTitle = Yii::$app->params['siteName']." - ".Yii::t('interface',"Settings")." - ".Yii::t('interface',"Social Networks");

        $model = new Quote;

        $quotes = new ActiveDataProvider([
            'query' => Quote::getQuotes(),
        ]);

        return $this->render('index.quotes.haml',compact('quotes','pageTitle','model'));
    }

    /**
     * Create Quote
     * 
     * @return string $view
     */
    public function actionCreate()
    {
        $pageTitle = Yii::$app->params['siteName']." - ".Yii::t('interface',"Testimonials");
        
        $model = new Quote;
        $model->type = "quote";

        $quotes = new ActiveDataProvider([
            'query' => Quote::getQuotes(),
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            FlashAlert::success(Yii::t('alerts',"Quote Saved Successfully."));

            return $this->redirect(['index']);
        
        } else if (!empty($model->getErrors())) {
            
            FlashAlert::danger(Yii::t('alerts',"Quote failed to save, check your form and try again."));

        }

        return $this->render('index.quotes.haml',compact('quotes','pageTitle','model'));
    }

    /**
     * Update Quote
     * 
     * @param  int $id Quote ID
     * @return string view
     */
    public function actionUpdate($id)
    {
        $pageTitle = Yii::$app->params['siteName']." - ".Yii::t('interface',"Testimonials")." - ".Yii::t('interface',"Update Testimonial");

        $model = Quote::findOne($id);

        $quotes = new ActiveDataProvider([
            'query' => Quote::getQuotes(),
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            FlashAlert::success(Yii::t('alerts',"Quote Saved Successfully."));

            return $this->redirect(['/quotes']);
        
        } else if (!empty($model->getErrors())) {
            
            FlashAlert::danger(Yii::t('alerts',"Quote failed to save, check your form and try again."));

        }

        return $this->render('update.quote.haml',compact('model','quotes','pageTitle'));
    }

    /**
     * Delete Network
     * 
     * @param  int $id Network ID
     * @return string $view
     */
    public function actionDelete($id)
    {
        $model = Quote::findOne($id);

        $model->delete();

        FlashAlert::danger(Yii::t('alerts',"Quote removed successfully."));

        return $this->redirect(['/quotes']);
    }

}