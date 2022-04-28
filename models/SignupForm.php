<?php

namespace app\models;
use yii\base\Model;

class SignupForm extends Model{
 

    public $fio;
    public $is_admin;
    public $inn;
    public $mail;
    public $tel;
    public $username;
    public $password;
    public $agent;
    public $authKey;
    public $accessToken;
 
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fio', 'inn', 'mail', 'tel', 'username', 'password'], 'required'],
            [['fio', 'inn', 'mail', 'tel', 'username', 'password', 'agent', 'authKey', 'accessToken'], 'string', 'max' => 255],
            [['is_admin'], 'integer'],
            // [['agent'], 'boolean'],
            [['authKey', 'accessToken', 'is_admin' ], 'default', 'value' => '0'],
            // [['agent' ], 'default', 'value' => false],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fio' => 'ФИО',
            'agent'=> 'Выберите группу пользователя:',
            'inn' => 'ИНН',
            'mail' => 'Email',
            'tel' => 'Телефон',
            'username' => 'Логин',
            'password' => 'Пароль',
            // 'authKey' => 'Auth Key',
            // 'accessToken' => 'Access Token',
        ];
    }
 
}