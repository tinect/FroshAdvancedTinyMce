<?php
/**
 * Shopware 4.0
 * Copyright © 2013 shopware AG
 *
 * According to our dual licensing model, this program can be used either
 * under the terms of the GNU Affero General Public License, version 3,
 * or under a proprietary license.
 *
 * The texts of the GNU Affero General Public License with an additional
 * permission and of our proprietary license can be found at and
 * in the LICENSE file you have received along with this program.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * "Shopware" is a registered trademark of shopware AG.
 * The licensing of the program under the AGPLv3 does not imply a
 * trademark license. Therefore any rights, title and interest in
 * our trademarks remain entirely with us.
 */

/**
 * @category  Shopware
 * @package   Shopware\Plugins\SwagCheapestPrice
 * @copyright Copyright (c) 2013, shopware AG (http://www.shopware.de)
 * @author    Heiner Lohaus
 */
class Shopware_Plugins_Backend_SwagAdvancedTinyMce_Bootstrap extends Shopware_Components_Plugin_Bootstrap
{
    /**
     * Returns the current version of the plugin.
     *
     * @return string
     */
    public function getVersion()
    {
        return '1.0.0';
    }

    /**
     * Returns a nice name for plugin manager list
     *
     * @return string
     * @return string
     */
    public function getLabel()
    {
        return 'Erweiterter TinyMCE';
    }

    /**
     * @return array
     */
    public function getInfo()
    {
        return array(
            'version' => $this->getVersion(),
            'label' => $this->getLabel(),
            'link' => 'http://www.shopware.de/',
        );
    }

	/**
	 * Install plugin method
	 *
	 * @return bool
	 */
	public function install()
	{
        $this->createMyForm();
        $this->createMyEvents();
        $this->createMyTables();
	 	return true;
	}

    private function createMyForm()
    {
        $form = $this->Form();
        $form->setName('TinyMce');
        $form->setElement('checkbox', 'useHtml5Schema', array(
            'label' => 'HTML5-Schema verwenden',
            'value' => true
        ));
        $form->setElement('select', 'skinVariant', array(
            'label' => 'Konfiguartion „skin_variant“',
            'value' => 'shopware',
            'store' => array(array('shopware', 'Shopware'), array('black', 'Black'), array('silver', 'Silver'))
        ));
        $extendedValidElements = array(
            'font[size]',
            'iframe[frameborder|src|width|height|name|align|allowfullscreen|id|class|style]',
            'script[src|type]',
            'object[width|height|classid|codebase|ID|value],param[name|value]',
            'embed[name|src|type|wmode|width|height|style|allowScriptAccess|menu|quality|pluginspage]',
            'video[autoplay|class|controls|id|lang|loop|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|preload|poster|src|style|title|width|height]',
            'audio[autoplay|class|controls|id|lang|loop|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|preload|src|style|title]',
        );
        $form->setElement('checkbox', 'useExtendedValidElements', array(
            'label' => 'Konfiguartion „extended_valid_elements“ verwenden',
            //'description' => '<a href="http://www.tinymce.com/wiki.php/configuration:extended_valid_elements">[help]</a>',
            'value' => false
        ));
        $form->setElement('textarea', 'extendedValidElements', array(
            'label' => 'Konfiguartion „extended_valid_elements“',
            'value' => implode(",\r\n", $extendedValidElements)
        ));
        $form->setElement('checkbox', 'usePlugins', array(
            'label' => 'Konfiguartion „plugins“ verwenden',
            'value' => true
        ));
        $form->setElement('textarea', 'plugins', array(
            'label' => 'Konfiguartion „plugins“',
            'value' => 'visualblocks,media_selection,safari,pagebreak,style,layer,table,iespell,inlinepopups,'
                     . 'insertdatetime,preview,searchreplace,print,contextmenu,paste,directionality,fullscreen,'
                     . 'visualchars,nonbreaking,xhtmlxtras,template',
        ));
        $form->setElement('checkbox', 'useThemeAdvancedButtons', array(
            'label' => 'Konfiguartion „theme_advanced_buttons“ verwenden',
            //'description' => '<a href="http://www.tinymce.com/wiki.php/configuration:content_css">[help]</a>',
            'value' => true
        ));
        $form->setElement('textarea', 'themeAdvancedButtons1', array(
            'label' => 'Konfiguartion „theme_advanced_buttons1“',
            'value' => 'save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect',
        ));
        $form->setElement('textarea', 'themeAdvancedButtons2', array(
            'label' => 'Konfiguartion „theme_advanced_buttons2“',
            'value' => 'cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code',
        ));
        $form->setElement('textarea', 'themeAdvancedButtons3', array(
            'label' => 'Konfiguartion „theme_advanced_buttons3“',
            'value' => 'tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,ltr,rtl,|,fullscreen',
        ));
        $form->setElement('textarea', 'themeAdvancedButtons4', array(
            'label' => 'Konfiguartion „theme_advanced_buttons4“',
            'value' => 'styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,|,insertdate,inserttime,preview,|,forecolor,backcolor,|,media_selection',
        ));
        $form->setElement('checkbox', 'useContentCss', array(
            'label' => 'Konfiguartion „content_css“ verwenden',
            //'description' => '<a href="http://www.tinymce.com/wiki.php/configuration:content_css">[help]</a>',
            'value' => false
        ));
        $form->setElement('textarea', 'contentCss', array(
            'label' => 'Konfiguartion „content_css“',
            'value' => 'backend/_resources/styles/tiny_mce.css',
        ));
        $form->setElement('checkbox', 'useStyleFormats', array(
            'label' => 'Konfiguartion „style_formats“ verwenden',
            //'description' => '<a href="http://www.tinymce.com/wiki.php/configuration:content_css">[help]</a>',
            'value' => true
        ));
        $form->setElement('textarea', 'styleFormats', array(
            'label' => 'Konfiguartion „style_formats“',
            'value' => <<<'EOD'
{title : 'Bold text', inline : 'b'},
{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
{title : 'Example 1', inline : 'span', classes : 'example1'},
{title : 'Example 2', inline : 'span', classes : 'example2'},
{title : 'Table styles'},
{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
EOD
        ));
    }

    private function createMyEvents()
    {
        $this->subscribeEvent(
            'Enlight_Controller_Action_PostDispatch_Backend_Index',
            'onPostDispatchBackend'
        );
        $this->subscribeEvent(
            'Enlight_Controller_Action_PostDispatch_Backend_Config',
            'onPostDispatchConfig'
        );
        $this->subscribeEvent(
            'Enlight_Controller_Dispatcher_ControllerPath_Backend_TinyMce',
            'getBackendControllerPath'
        );
    }

    private function createMyTables()
    {
        $queries = array("
			CREATE TABLE IF NOT EXISTS `s_plugin_tiny_mce_templates` (
			  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
			  `title` varchar(255) NOT NULL,
			  `description` varchar(255) NULL,
			  `content` text NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
		");

        foreach ($queries as $query) {
            Shopware()->Db()->exec($query);
        }
    }

    /**
     * Update the plugin
     *
     * @param string $version
     * @return bool|void
     */
    public function update($version)
    {
        return $this->install();
    }

	/**
	 * Uninstall plugin method
	 *
	 * @return bool
	 */
	public function uninstall()
	{
		return true;
	}

    public function onPostDispatchBackend(Enlight_Event_EventArgs $args)
    {
        /** @var Enlight_Controller_Action $subject */
        $subject = $args->getSubject();
        $request = $subject->Request();
        $view = $subject->View();

        if($request->getActionName() != 'index') {
            return;
        }
        $view->addTemplateDir(
            $this->Path() . 'Views/', 'SwagAdvancedTinyMce'
        );
        $view->assign('tinyMceConfig', $this->Config());
        $view->extendsTemplate('backend/base/tiny_mce.tpl');
    }

    public function onPostDispatchConfig(Enlight_Event_EventArgs $args)
    {
        /** @var Enlight_Controller_Action $subject */
        $subject = $args->getSubject();
        $view = $subject->View();
        if (!$view->hasTemplate()) {
            return;
        }
        $view->addTemplateDir(
            $this->Path() . 'Views/', 'SwagAdvancedTinyMce'
        );
        $view->extendsTemplate("backend/config/tiny_mce.js");
    }

    public function getBackendControllerPath(Enlight_Event_EventArgs $args)
    {
        $this->registerCustomModels();
        $this->Application()->Template()->addTemplateDir(
            $this->Path() . 'Views/', 'SwagAdvancedTinyMce'
        );
        return $this->Path() . 'Controllers/Backend/TinyMce.php';
    }
}
