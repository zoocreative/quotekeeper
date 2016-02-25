<?php

namespace mightyzoo\quotekeeper;

use Yii;
use yii\base\BootstrapInterface;
use yii\console\Application as ConsoleApplication;
use yii\i18n\PhpMessageSource;
use yii\web\GroupUrlRule;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        if ($app->hasModule('quotes') && ($module = $app->getModule('quotes')) instanceof Module) {

            $configUrlRule = [
                'prefix' => $module->urlPrefix,
                'rules'  => $module->urlRules,
            ];

            if ($module->urlPrefix != 'quotes') {
                $configUrlRule['routePrefix'] = 'quotes';
            }

            $app->urlManager->addRules([new GroupUrlRule($configUrlRule)], false);

        }
    }
}
