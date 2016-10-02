<?php
// src/AppBundle/Entity/User.php

namespace WebDiaryBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser {
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    
    /**
     * @ORM\OneToMany(targetEntity="Student_subjects", mappedBy="student")
     */
    private $subjects;

    
    /**
     * @ORM\ManyToOne(targetEntity="Classes", inversedBy="students")
     * @ORM\JoinColumn(name="class_id", referencedColumnName="id")
     */
    private $class;
    


    public function __construct() {
        parent::__construct();
        $this->subjects = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add subjects
     *
     * @param \WebDiaryBundle\Entity\Student_subjects $subjects
     * @return User
     */
    public function addSubject(\WebDiaryBundle\Entity\Student_subjects $subjects)
    {
        $this->subjects[] = $subjects;

        return $this;
    }

    /**
     * Remove subjects
     *
     * @param \WebDiaryBundle\Entity\Student_subjects $subjects
     */
    public function removeSubject(\WebDiaryBundle\Entity\Student_subjects $subjects)
    {
        $this->subjects->removeElement($subjects);
    }

    /**
     * Get subjects
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSubjects()
    {
        return $this->subjects;
    }

    /**
     * Set class
     *
     * @param \WebDiaryBundle\Entity\Classes $class
     * @return User
     */
    public function setClass(\WebDiaryBundle\Entity\Classes $class = null)
    {
        $this->class = $class;

        return $this;
    }

    /**
     * Get class
     *
     * @return \WebDiaryBundle\Entity\Classes 
     */
    public function getClass()
    {
        return $this->class;
    }
}
