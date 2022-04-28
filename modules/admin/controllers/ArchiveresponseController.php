<?php

namespace app\modules\admin\controllers;

use app\models\Bid;
use app\models\Archiveresponse;
use app\models\ArchiveresponseSearch;
use app\models\Response;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\User;
use Yii;
/**
 * ArchiveresponseController implements the CRUD actions for Archiveresponse model.
 */
class ArchiveresponseController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }
    public function actionDateofarchive($date_start, $date_end)
    {
        $searchModel = new ArchiveresponseSearch();
        $dataProvider = $searchModel->searchquery($this->request->queryParams);

        // $query = Archive::find()->where(['>','end_date', $date_start])->andWhere(['<','end_date', $date_end])->orderBy(['id'=>SORT_DESC]) ;
        // echo '<pre>';var_dump($this->request->queryParams);die;

        return $this->render('dateofarchive', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]); 
    }
    /**
     * Lists all ArchiveArchiveresponse models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ArchiveresponseSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Archiveresponse model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionEndBid()
    {
        Yii::$app->mailer->compose()
        ->setFrom('info@oil.grain.ru')
        ->setTo(['vorobyova_vv@grain.ru','lisitskaya_us@grain.ru'])
        ->setSubject('Окончание заявки №')
        ->setHtmlBody('<b>На сайте oil.grain.ru появился новый отклик.</b>')
        ->send();
        return $this->redirect(['/admin/bid']);
    }
    public function actionView($id)
    {   
        
        return $this->redirect(['/admin/bid']);
    }

    /**
     * Creates a new Archiveresponse model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Archiveresponse
     */
    public function actionCreate()
    {   
        $id_user =  Yii::$app->user->getId();
        $id_bid = $this->request->get('id');
        $bid_price_max = Bid::find()->where(['id'=>$id_bid])->one() ;
        $price_max = $bid_price_max->price;
        $volume = $bid_price_max->volume;

        $model = new Archiveresponse();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                Yii::$app->mailer->compose()
                ->setFrom('info@oil.grain.ru')
                ->setTo(['vorobyova_vv@grain.ru','lisitskaya_us@grain.ru'])
                ->setSubject('Новый отклик')
                ->setHtmlBody('<b>На сайте oil.grain.ru появился новый отклик.</b>')
                ->send();
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'id_bid'=>$id_bid,
            'id_user'=>$id_user,
            'price_max'=> $price_max ,
            'volume'=> $volume ,
            
        ]);
    }

    /**
     * Updates an existing Archiveresponse model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Archiveresponse
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
       
        return $this->render('update', [
            'model' => $model,
            'id_bid'=>$model->id_bid,
            'id_user'=>$model->id_user,
            'price_max'=> $model->price ,
            'volume'=> $model->volume ,
        ]);
    }

    /**
     * Deletes an existing Archiveresponse model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Archiveresponse
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Archiveresponse model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Archiveresponse the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Archiveresponse::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
