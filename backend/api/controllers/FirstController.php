<?php

namespace backend\api\controllers;

use app\api\models\User;
use backend\api\models\UserCreateForm;
use backend\api\models\Userprofile;
use Yii;
use yii\helpers\Json;
use yii\rest\Controller;

//classe controla  os acessos dos utilizadores ás areas restritas do site e contas dos mesmos

class FirstController extends Controller
{
    public $modelClass = 'app\api\models\User';

    public function getPost(){
        return Yii::$app->request->post();
    }

    public function actionLogin(){
        $jsonPost = $this->getPost();

        if($jsonPost !== null&&$jsonPost['email']&&$jsonPost['password']){

            if (User::find()->where(["email"=>$jsonPost['email']])->one()){
                $user=User::find()->where(["email"=>$jsonPost['email']])->one();
                $hash = User::findByUsername($user->getAttribute("username"));

                if (Yii::$app->getSecurity()->validatePassword($jsonPost['password'], $hash->password_hash)) {
                    $userProfile = Userprofile::find()->where(['userid'=>$user->getAttribute('id')])->one();
                    $profileId = $userProfile->getAttribute('id');
                    $nif = $userProfile->getAttribute('nif');
                    $name = $userProfile->getAttribute('name');
                    $email = $user->getAttribute('email');
                    $cellphone = $userProfile->getAttribute('cellphone');
                    $street = $userProfile->getAttribute('street');
                    $door = $userProfile->getAttribute('door');
                    if ($userProfile->getAttribute('floor')!=null){
                        $floor = $userProfile->getAttribute('floor');
                    }else{
                        $floor = 0;
                    }
                    $city = $userProfile->getAttribute('city');
                    $userId = $userProfile->getAttribute('userid');
                    $userToken = User::findByUsername($user->getAttribute("username"))->getAuthKey();

                    $userRole = User::findOne(['id'=>$userId])->getRole($userId)->item_name;

                    $jsonResponse = array('success'=>true,'profileId'=>$profileId,'nif'=>$nif,'name'=>$name,'email'=>$email,
                        'cellphone'=>$cellphone,'street'=>$street,'door'=>$door,'floor'=>$floor,'city'=>$city,'userId'=>$userId,'token'=>$userToken,'role'=>$userRole);
                } else {
                    $jsonResponse = array('success'=>'sem acesso ');
                }
            }
        }else{
            $jsonResponse = array('success'=>false);

        }
        return Json::encode($jsonResponse);
    }

    public function actionRegister(){
        $jsonPost = $this->getPost();
        if (User::findByUsername($jsonPost['username'])==null&&User::find()->where(['email'=>$jsonPost['email']])->one()==null) {
            $modelNewUser = new UserCreateForm();
            $modelNewUser->username = $jsonPost['username'];
            $modelNewUser->email = $jsonPost['email'];
            $modelNewUser->password = $jsonPost['password'];

            $modelNewUser->signup();
            $user = User::findByUsername($jsonPost['username']);
            $jsonResponse =  array('success'=>true ,'id'=>$user->id ,'username'=>$user->username ,'email'=>$user->email);
        }else
            $jsonResponse = array('message'=>'failed');

        return  Json::encode($jsonResponse);
    }

    public function actionLogout(){
        Yii::$app->user->logout();

        return   Json::encode(array('success'=>true,'status'=>'logedout'));
    }

    public function actionDelete(){
        $jsonPost = $this->getPost();

        return  Json::encode(User::findOne(['id'=>$jsonPost['id']])->delete());
    }

}