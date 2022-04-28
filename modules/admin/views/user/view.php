<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;
/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <h1><?=$model->fio;?></h1>

     <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
      <!--  <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>-->
    </p> 

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            //'fio',
            'inn',
            'mail',
            'tel',
            'agent',
            // [
            //     'attribute'=>'agent',
            //     'value'=> function($data) { 
            //             $agent = $data->agent;
            //             if ($agent==1) {
            //                 $agent = 'Агент';
            //             } else {
            //                 $agent = 'Не агент';
            //             }
            //             return $agent;
            //         }
            // ],
            'username',
            [
                'attribute'=>'password',
                'value'=> function($data) { 
                        $my_id = Yii::$app->user->getId();
                        $user = User::find()->where(['id'=>$my_id])->one();
                        $is_admin = $user->is_admin;
                        $id_user = $data->id;

                        //var_dump( $is_admin , '-------id_user:',$id_user, '-------my_id:', $my_id);die;
                        if ( $is_admin==1 ) {
                            $user_password = $data->password;
                        } else if ($is_admin==2 and $id_user == $my_id) {
                            $user_password = $data->password;
                        } else if ( $id_user == $my_id ) {
                            $user_password = $data->password;
                        } else {
                            $user_password = '*******';
                        }
                        return $user_password;
                    }
            ],
                
            // 'username',
            // 'password',
            // 'authKey',
            // 'accessToken',
        ],
    ]) ?>

</div>
