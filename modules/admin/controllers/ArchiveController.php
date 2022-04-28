<?php

namespace app\modules\admin\controllers;

use app\models\Archive;
use app\models\ArchiveSearch;
use app\models\Response;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\User;
use Yii;
use kartik\mpdf\Pdf;

/**
 * ArchiveController implements the CRUD actions for Archive model.
 */
class ArchiveController extends Controller
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
        $searchModel = new ArchiveSearch();
        $dataProvider = $searchModel->searchquery($this->request->queryParams);

        // $query = Archive::find()->where(['>','end_date', $date_start])->andWhere(['<','end_date', $date_end])->orderBy(['id'=>SORT_DESC]) ;
        // echo '<pre>';var_dump($this->request->queryParams);die;

        return $this->render('dateofarchive', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]); 
    }
    /**
     * Lists all Archive models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ArchiveSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $userId = Yii::$app->user->getId();
        $user = User::find()->where(['id' => $userId])->one();
        $is_admin = $user->is_admin;
       // $dates = Bid::find()->where(['id' => $userId])->one();
        // $date_now = date('Y-m-d H:i:s');
        // var_dump($date_now);die;


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'is_admin' => $is_admin,
            'user' => $user,
           // 'dates'=> $dates,
        ]);
    }

    /**
     * Displays a single Archive model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $responses = Response::find()->where(['id_bid' => $id])->orderBy(['price' => SORT_ASC])->all();
        
        return $this->render('view', [
            'model' => $this->findModel($id),
            'responses' => $responses,
        ]);
    }

    /**
     * Creates a new Archive model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Archive();
        // $bid = $this->request->post();
        // var_dump($bid['Bid']['logistic']);die;
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }



    /**
     * Updates an existing Archive model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
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
        ]);
    }

    /**
     * Deletes an existing Archive model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Archive model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Archive the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Archive::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionCreatebid($id_bid)
    {

        return $this->redirect(['response/create', 'id' => $id_bid]);
        // var_dump($id_bid);die;
    }


    public function actionPrintbid($id_bid)
    {
        $model = $this->findModel($id_bid);
        $responses = Response::find()->where(['id_bid' => $id_bid])->orderBy(['price' => SORT_ASC])->all();
        $content = $this->renderPartial('view', [
            'model' => $this->findModel($id_bid),
            'responses' => $responses,
        ]);
       // $content = htmlspecialchars($content);
    //    $mpdf = new mPDF('utf-8', 'A4', '10', 'Arial', 0, 0, 5, 5, 5, 5);
    //    $mpdf->charset_in = 'utf-8';
       // var_dump($content);die;
        $pdf = new \kartik\mpdf\Pdf([
            'mode' => \kartik\mpdf\Pdf::MODE_CORE, 
            'format' => \kartik\mpdf\Pdf::FORMAT_A4, 
            'orientation' => \kartik\mpdf\Pdf::ORIENT_PORTRAIT, 
            'destination' => \kartik\mpdf\Pdf::DEST_BROWSER, 
            'content' => $content, 
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            'cssInline' => '.img-circle {border-radius: 50%;}', 
            'options' => [
                'title' => 'Заявка №'. $id_bid,
                'subject' => 'PDF'
            ],
            'methods' => [
                'SetHeader' => Yii::$app->name,
                'SetFooter' => ['|{PAGENO}|'],
            ]
        ]);
       
        return $pdf->render();
    }
}
