<?php

namespace app\commands;

/**
 * Description of DeadlineRemind
 *
 * @author Lex
 */
class RbacController extends \yii\console\Controller {
    
    /**
     * Sends an e-mail reminders for all ections which soon expire.
     */
    public function actionInit() {
        
        $am = \Yii::$app->authManager;
        
        $admin = $am->createRole('admin');
        $manager = $am->createRole('manager');
        
        $am->add($admin);
        $am->add($manager);
        
        $operationCreate = $am->createPermission('createTask');
        $operationDelete = $am->createPermission('deleteTask');
        
        $am->add($operationCreate);
        $am->add($operationDelete);
        
        $am->addChild($admin, $operationCreate);
        $am->addChild($admin, $operationDelete);

        $am->addChild($manager, $operationCreate);
        
        $am->assign($admin, 5);
        $am->assign($manager, 6);
        
        return 0;
    }
}
