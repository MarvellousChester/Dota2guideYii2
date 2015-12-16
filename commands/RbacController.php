<?php
namespace app\commands;
 
use Yii;
use yii\console\Controller;
use \app\rbac\UserRoleRule;
use \app\rbac\UserProfileOwnerRule;
 
class RbacController extends Controller
{
    public function actionInit()
    {
        $authManager = \Yii::$app->authManager;
        $authManager->removeAll();
        // Create roles
        $user  = $authManager->createRole('user');
        $admin  = $authManager->createRole('admin');
 
        // Create simple, based on action{$NAME} permissions
        $login  = $authManager->createPermission('login');
        $logout = $authManager->createPermission('logout');
        $error  = $authManager->createPermission('error');
        $signUp = $authManager->createPermission('sign-up');
        $index  = $authManager->createPermission('index');
        $view   = $authManager->createPermission('view');
        $update = $authManager->createPermission('update');
        $delete = $authManager->createPermission('delete');
        
 
        // Add permissions in Yii::$app->authManager
        $authManager->add($login);
        $authManager->add($logout);
        $authManager->add($error);
        $authManager->add($signUp);
        $authManager->add($index);
        $authManager->add($view);
        $authManager->add($update);
        $authManager->add($delete);
        
 
        

 
        // Add rule, based on UserExt->role === $user->role
        $userRoleRule = new UserRoleRule();
        $authManager->add($userRoleRule);
 
        $userProfileOwnerRule = new UserProfileOwnerRule();
        $authManager->add($userProfileOwnerRule);
        $updateOwnProfile = $authManager->createPermission('updateOwnProfile');
        $updateOwnProfile->ruleName = $userProfileOwnerRule->name;
        $authManager->add($updateOwnProfile);
        // Add rule "UserRoleRule" in roles
        $user->ruleName  = $userRoleRule->name;
        $admin->ruleName  = $userRoleRule->name;
 
        // Add roles in Yii::$app->authManager
        $authManager->add($user);
        $authManager->add($admin);
 
        // Add permission-per-role in Yii::$app->authManager
        // user
        $authManager->addChild($user, $login);
        $authManager->addChild($user, $logout);
        $authManager->addChild($user, $error);
        $authManager->addChild($user, $signUp);
        $authManager->addChild($user, $index);
        $authManager->addChild($user, $view);
        $authManager->addChild($user, $update);
        $authManager->addChild($user, $updateOwnProfile);
 
        // Admin
        $authManager->addChild($admin, $delete);
        $authManager->addChild($admin, $user);
    }
}