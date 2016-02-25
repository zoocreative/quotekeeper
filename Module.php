<?php
namespace mightyzoo\quotekeeper;

class Module extends \yii\base\Module
{

    /** @var array Model map */
    public $modelMap = [];

    /**
     * @var string The prefix for user module URL.
     *
     * @See [[GroupUrlRule::prefix]]
     */
    public $urlPrefix = 'products';

    /** @var array The rules to be used in URL management. */
    public $urlRules = [
        'toast' => 'default/toast',
    ];

    public function init()
    {
        parent::init();

    }
}