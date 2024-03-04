<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        // add "createPost" permission
        $createPost = $auth->createPermission('createPost');
        $createPost->description = 'Create a post';
        $auth->add($createPost);

        // add "updatePost" permission
        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description = 'Update post';
        $auth->add($updatePost);

        // add "accessBackEnd" permission
        $accessBackend = $auth->createPermission('accessBackend');
        $accessBackend->description = 'Access the Back-Office';
        $auth->add($accessBackend);

        // add "staff" role and give this role the "createPost" permission
        $staff = $auth->createRole('staff');
        $auth->add($staff);
        $auth->addChild($staff, $accessBackend);

        // add "chef" role and give this role the "createPost" permission
        $chef = $auth->createRole('chef');
        $auth->add($chef);
        $auth->addChild($chef, $accessBackend);

        // add "client" role and give this role the "createPost" permission
        $client = $auth->createRole('client');
        $auth->add($client);
        $auth->addChild($client, $createPost);

        // add "admin" role and give this role the "updatePost" permission
        // as well as the permissions of the "author" role
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $updatePost);
        $auth->addChild($admin, $staff);
        $auth->addChild($admin, $accessBackend);

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.

        $auth->assign($admin, 1);
        $auth->assign($staff, 2);
        $auth->assign($chef, 3);
        $auth->assign($client, 4);
    }
}