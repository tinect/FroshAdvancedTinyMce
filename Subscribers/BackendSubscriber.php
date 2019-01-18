<?php

namespace FroshAdvancedTinyMce\Subscribers;

use Enlight\Event\SubscriberInterface;

class BackendSubscriber implements SubscriberInterface
{
    private $pluginPath;

    private $config;

    public function __construct($pluginPath, $config)
    {
        $this->pluginPath = $pluginPath;
        $this->config = $config;
    }

    public static function getSubscribedEvents()
    {
        return [
            'Enlight_Controller_Action_PostDispatch_Backend_Config' => 'onPostDispatchBackendConfig',
            'Enlight_Controller_Action_PostDispatch_Backend_Index' => 'onPostDispatchBackendIndex',
            'Enlight_Controller_Dispatcher_ControllerPath_Backend_TinyMce' => 'getBackendControllerPath'
        ];
    }

    function onPostDispatchBackendIndex(\Enlight_Controller_ActionEventArgs $args)
    {
        $request = $args->getRequest();
        $view = $args->getSubject()->View();

        if($request->getActionName() != 'index') {
            return;
        }

        $view->addTemplateDir($this->pluginPath . '/Resources/views');
        $view->assign('tinyMceConfig', $this->config);
        $view->extendsTemplate('backend/base/tiny_mce.tpl');
    }

    public function onPostDispatchBackendConfig(\Enlight_Controller_ActionEventArgs $args)
    {
        $request = $args->getRequest();
        $view = $args->getSubject()->View();

        if (!$view->hasTemplate()) {
            return;
        }

        $view->addTemplateDir($this->pluginPath . '/Resources/views');
        $view->extendsTemplate('backend/config/tiny_mce.js');
    }

    public function getBackendControllerPath(\Enlight_Event_EventArgs $args)
    {
        return $this->pluginPath . '/Controllers/Backend/TinyMce.php';
    }
}