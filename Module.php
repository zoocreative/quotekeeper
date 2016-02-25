<?php
namespace mightyzoo\quotekeeper;

class Module extends \yii\base\Module
{

     /** @var array Model map */
    public $modelMap = [];

    /** @var array The rules to be used in URL management. */
    public $urlRules = [
        'GET quotes' => 'quotes/quote/index',
        'POST quotes' => 'quotes/quote/create',
        'PATCH,PUT quotes/<id>' => 'quotes/quote/update',
        'DELETE quotes/<id>' => 'quotes/quote/delete',
    ];

    public function init()
    {
        parent::init();

    }
}