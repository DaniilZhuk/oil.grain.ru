<?php

namespace app\modules\admin\controllers;

use app\models\Bid;
use app\models\BidSearch;
use app\models\Response;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\User;
use Yii;
use kartik\mpdf\Pdf;

/**
 * BidController implements the CRUD actions for Bid model.
 */
class BidController extends Controller
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

    /**
     * Lists all Bid models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new BidSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $userId = Yii::$app->user->getId();
        $user = User::find()->where(['id' => $userId])->one();
        $is_admin = $user->is_admin;
        // $date_now = date('Y-m-d H:i:s');
        // var_dump($date_now);die;
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'is_admin' => $is_admin,
            'user' => $user,
        ]);
    }
    public function actionSigned($id_response, $id_bid)
    {
        $responses = Response::find()->where(['id' => $id_response])->one();
        $responses->signed = 1;
        if ( $responses->save()){
            return $this->actionView($id_bid); 
        } else {
            var_dump("NOOOOOO");
        }               
    }
    /**
     * Displays a single Bid model.
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
     * Creates a new Bid model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Bid();
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


    public function actionSendMail()
    {
        
        Yii::$app->mailer->compose()
        ->setFrom('info@oil.grain.ru')
        ->setTo(['daniil10i@mail.ru','info@it-vector.com', 'it.team.zhuchenko@yandex.ru'])
        ->setSubject('Новая заявка №')
        ->setTextBody('Появилась новая заявка!')
        ->setHtmlBody('<b><a href="/admin/bid"> ПОСМОТРЕТЬ </a> </b>')
        ->send();
       
    }

    public function actionCreateBids()
    {

        $c = 3;
        $v = 5;
        while ($c >= 1) {
            while ($v >= 1) {
                $model = new Bid();
                $model->basis = Bid::countBasis($c);
                $model->volume = Bid::countVolume($v);
                $model->price = '105';
                $model->nomenclature = ['Масло подсолнечное нерафинированное промышленной переработки / Масло подсолнечное нерафинированное первого сорта'];
                $model->end_date = date('Y-m-d 14:00:00'); //  date('Y-m-d 14:00:00')
                $v--;
                $model->save();
               
            }
            $v = 5;
            $c--;
        }

        
         // отправка всем пользователям уведомлений ОТ СЮДА 
         $usersNoAdmin = User::find()->where(['is_admin' => !1])->andWhere(['is_admin' => !2])->orderBy('id')->all();
         foreach($usersNoAdmin as $user)
         { 
             Yii::$app->mailer->compose()
             ->setFrom('info@oil.grain.ru')
             ->setTo($user->mail)
             ->setSubject('Новые заявки')
             ->setHtmlBody('<b>На сайте oil.grain.ru появились новые заявки.</b>')
             ->send();
         } 
         // ДО СЮДА

        return $this->redirect(['index']);
    }
   

    /**
     * Updates an existing Bid model.
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
     * Deletes an existing Bid model.
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
     * Finds the Bid model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Bid the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Bid::findOne(['id' => $id])) !== null) {
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
                'title' => 'Заявка №' . $id_bid,
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
