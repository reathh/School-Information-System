<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Settings
 *
 * @ORM\Table(name="settings")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SettingsRepository")
 */
class Settings
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * Get id
     *
     * @return int
     */

    /**
     * @var string
     * @ORM\Column(name="defaultColorForContent")
     */
    private $defaultColorForContent;
    
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set defaultColorForContent
     *
     * @param string $defaultColorForContent
     *
     * @return Settings
     */
    public function setDefaultColorForContent($defaultColorForContent)
    {
        $this->defaultColorForContent = $defaultColorForContent;

        return $this;
    }

    /**
     * Get defaultColorForContent
     *
     * @return string
     */
    public function getDefaultColorForContent()
    {
        return $this->defaultColorForContent;
    }
}
