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
    public function actionRemindDeadlines() {
        date_default_timezone_set('Europe/Moscow'); 
        $date = date("Y-m-d H:i:s", time() + 3*24*60*60); // Прокручиваю три дня в секундах
        
        // Получаем задания, которые уже истекли, или скоро истекут
        $tasks = \app\models\tables\Task::find()
                ->andWhere('tasks.date <= :date', [':date' => $date])
                ->with('user')
                ->asArray()
                ->all();
        
        foreach ($tasks as $key => $task) {
            // Собираем контактер (наследник ContactForm)
            $contacter = new \app\models\Contacter([
                'name' => 'Ваш Любимый Начальник',
                'subject' => 'Напоминание: ' . $task['name'],
                'email' =>  'nachalnik@thegreat.org',
                'body' => 'На вас числится следующее задание: ' . $task['description'] .  'Выполнить до ' . $task['date'] ,
            ]);
            
            // Пробуем отправить и выводим сообщение о результате
            if($contacter->contact($task['user']['email'])){
                echo "ОТПРАВЛЕНО - '{$contacter['subject']}' на почту '{$task['user']['email']}'";
            }else{
                echo "НЕ ОТПРАВЛЕНО - '{$contacter['subject']}' на почту '{$task['user']['email']}'";;
            }
            echo PHP_EOL;
        }
        
        return 0;
    }
}
