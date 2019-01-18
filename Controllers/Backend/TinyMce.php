<?php
/**
 * Shopware 4.0
 * Copyright � 2013 shopware AG
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

use Shopware\CustomModels\TinyMce\Template;

/**
 * @category  Shopware
 * @package   Shopware\Plugins\SwagCustomizing
 * @copyright Copyright (c) 2013, shopware AG (http://www.shopware.de)
 */
class Shopware_Controllers_Backend_TinyMce extends Shopware_Controllers_Backend_ExtJs
{
    public function preDispatch()
    {
        if (!in_array($this->Request()->getActionName(), array('getRawTemplateList'))) {
            parent::preDispatch();
        }
    }

    /**
     * @return Shopware\Components\Model\ModelManager
     */
    public function getModelManager()
    {
        return Shopware()->Models();
    }

    /**
     * @return Shopware\Components\Model\ModelRepository
     */
    public function getTemplateRepository()
    {
        return $this->getModelManager()->getRepository(Template::class);
    }

    public function getTemplateListAction()
    {
        $repository = $this->getTemplateRepository();
        $query = $repository->queryBy(
            (array)$this->Request()->getParam('filter', array()),
            (array)$this->Request()->getParam('order', array()),
            (int)$this->Request()->getParam('limit', 30),
            (int)$this->Request()->getParam('start', 0)
        );
        $data = $query->getArrayResult();
        $this->View()->assign(array('success' => true, 'data' => $data));
    }

    public function saveTemplateAction()
    {
        $manager = $this->getModelManager();
        $data = $this->Request()->getPost();
        $data = isset($data[0]) ? array_pop($data) : $data;
        $repository = $this->getTemplateRepository();
        /** @var $model Template */
        $model = null;

        if (!empty($data['id'])) {
            $model = $repository->find($data['id']);
        } else {
            $model = $repository->getClassName();
            $model = new $model();
            $manager->persist($model);
        }

        $model->fromArray($data);
        $manager->flush();

        $data['id'] = $model->getId();

        $this->View()->assign(array(
            'success' => true,
            'data' => $data
        ));
    }

    public function deleteTemplateAction()
    {
        $manager = $this->getModelManager();
        $id = $this->Request()->getParam('id');
        $repository = $this->getTemplateRepository();
        $model = $repository->find($id);
        $manager->remove($model);
        $manager->flush();
        $this->View()->assign(array(
            'success' => true
        ));
    }

    public function getRawTemplateListAction()
    {
        $repository = $this->getTemplateRepository();
        $queryBuilder = $repository->createQueryBuilder('t');
        $queryBuilder->select(array(
            't.name',
            't.description',
            't.content',
        ));
        $query = $queryBuilder->getQuery();
        $templates = $query->getArrayResult();
        $this->View()->assign(array(
            'templates' => $templates
        ));
    }
}