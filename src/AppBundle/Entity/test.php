<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * test
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\testRepository")
 */
class test
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="test_name", type="string", length=70)
     */
    private $testName;

    /**
     * @var string
     *
     * @ORM\Column(name="summary", type="text")
     */
    private $summary;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set testName
     *
     * @param string $testName
     *
     * @return test
     */
    public function setTestName($testName)
    {
        $this->testName = $testName;

        return $this;
    }

    /**
     * Get testName
     *
     * @return string
     */
    public function getTestName()
    {
        return $this->testName;
    }

    /**
     * Set summary
     *
     * @param string $summary
     *
     * @return test
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;

        return $this;
    }

    /**
     * Get summary
     *
     * @return string
     */
    public function getSummary()
    {
        return $this->summary;
    }
}

