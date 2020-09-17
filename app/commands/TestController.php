<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;
use app\models\Term;
use app\models\Project;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class TestController extends Controller
{
    /**
     * projects and terms data
     */
    private $projects = [
        [
            'name' => 'ECサイト',
            'remarks' => 'Amazon社のECサイト構築',
            'terms' => [
                [
                    'language' => 'ja',
                    'vocabulary' => '決済',
                    'description' => 'お金を支払う',
                    'type' => 1,
                ],
                [
                    'language' => 'vi',
                    'vocabulary' => 'Quyết toán',
                    'description' => 'Trả tiền',
                    'type' => 1,
                    'parent' => '決済',
                ],
                [
                    'language' => 'ja',
                    'vocabulary' => '出品',
                    'description' => '品物を売るために店舗に載せる',
                    'type' => 1,
                ],
                [
                    'language' => 'vi',
                    'vocabulary' => 'Đăng ký sản phẩm',
                    'description' => 'Đưa sản phẩm lên kệ hàng online',
                    'type' => 1,
                    'parent' => '出品',
                ],
            ],
        ],
        [
            'name' => 'PC管理',
            'remarks' => '会社のPC管理システム',
            'terms' => [
                [
                    'language' => 'ja',
                    'vocabulary' => '登録',
                    'description' => 'システムに情報を登録する',
                    'type' => 1,
                ],
                [
                    'language' => 'vi',
                    'vocabulary' => 'Đăng ký',
                    'description' => 'Đăng ký thông tin vào hệ thống',
                    'type' => 1,
                    'parent' => '登録',
                ],
                [
                    'language' => 'ja',
                    'vocabulary' => '貸出',
                    'description' => '人にPCを貸し出す。',
                    'type' => 1,
                ],
                [
                    'language' => 'vi',
                    'vocabulary' => 'Cho mượn',
                    'description' => 'Cho nhân viên mượn máy tính',
                    'type' => 1,
                    'parent' => '貸出',
                ],
            ],

        ],
    ];
    
    /**
     * This command generate project and term from array $this->projects.
     * command: php yii test/generate-project-and-term
     */
    public function actionGenerateProjectAndTerm()
    {
        foreach($this->projects as $projectData){
            $this->registerProjectAndTerm($projectData);
        }
    echo "DONE\n";
    }

    private function registerProjectAndTerm($projectData)
    {
        //register project
        $project = $this->registerProject($projectData);
        //register terms        
        foreach($projectData['terms'] as $termData){
            $this->registerTerm($project, $termData);
        }
    }

    /**
     * @param array
     * @return Project
     */
    private function registerProject($projectArr)
    {
        $project = $this->findOneCreateNew(Project::class, [
            'name' => $projectArr['name'],
        ], false);
        $project->remark = $projectArr['remarks'];
        $project->save();
        return $project;
    }

    /**
     * @param Project
     * @param array
     * @return Term 
     */
    private function registerTerm($project, $termArr)
    {
        $term = $this->findOneCreateNew(Term::class, [
            'project_id' => $project->id,
            'vocabulary' => $termArr['vocabulary'],
            'language' => $termArr['language'],
        ], false);
        $term->type = $termArr['type'];
        $term->description = $termArr['description'];
        if (isset($termArr['parent'])) {
            $parent = self::findOneCreateNew(Term::class, [
                'project_id' => $project->id,
                'vocabulary' => $termArr['parent'],
            ], FALSE);
            if ($parent->id) {
                $term->parent_term_id = $parent->id;
            }
        }
        $term->save();
        return $term;
    }

    /**
     * @param string $className
     * @param array $condition
     * @param boolean $saveDb
     */
    private function findOneCreateNew($className, $condition, $saveDb)
    {
        $result = $className::findOne($condition);
        if(!$result){
            $result = \Yii::createObject($className);
            \Yii::configure($result, $condition);            
        }
        if($saveDb){
            $result->save();
        }
        return $result;
    }
}
