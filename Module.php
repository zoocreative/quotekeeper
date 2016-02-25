<?php
namespace mightyzoo\quotekeeper;

class Module extends \yii\base\Module
{

     /** @var array Model map */
    public $modelMap = [];

    /** @var array The rules to be used in URL management. */
    public $urlRules = [
        'GET quotes' => 'quotes/default/index',
        'POST quotes' => 'quotes/default/create',
        'PATCH,PUT quotes/<id>' => 'quotes/default/update',
        'DELETE quotes/<id>' => 'quotes/default/delete',
    ];

    public function init()
    {
        parent::init();

    }
}