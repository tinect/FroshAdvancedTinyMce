<?php

namespace Shopware\CustomModels\TinyMce;
use Shopware\Components\Model\ModelEntity,
    Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="s_plugin_tiny_mce_templates")
 * @ORM\Entity
 */
class Template extends ModelEntity
{
    /**
     * @var integer $id
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string $name
     * @ORM\Column(name="title", type="string", nullable=false)
     */
    private $name;

    /**
     * @var string $description
     * @ORM\Column(name="description", type="string", nullable=true)
     */
    private $description;

    /**
     * @var string $content
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    private $content;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }
}