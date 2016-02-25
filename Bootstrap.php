<?php

namespace mightyzoo\quotekeeper;

use Yii;
use yii\base\BootstrapInterface;
use yii\console\Application as ConsoleApplication;
use yii\i18n\PhpMessageSource;
use yii\web\GroupUrlRule;

class Bootstrap implements BootstrapInterface
{
    /** @inheritdoc */
    public function bootstrap($app)
    {
        /** @var Module $module */
        /** @var \yii\db\ActiveRecord $modelName */
        if ($app->hasModule('quotes') && ($module = $app->getModule('quotes')) instanceof Module) {

            $app->urlManager->addRules($module->urlRules, false);
            
        }
    }
}
