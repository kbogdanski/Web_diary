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
    private $studentSubjects;

    
    /**
     * @ORM\ManyToOne(targetEntity="Classes", inversedBy="students")
     * @ORM\JoinColumn(name="class_id", referencedColumnName="id")
     */
    private $class;
    
    
    /**
     * @ORM\OneToMany(targetEntity="Classes", mappedBy="teacher")
     */
    private $classTeachers;
    
    
    /**
     * @ORM\OneToMany(targetEntity="Class_subjects", mappedBy="subjectTeacher")
     */
    private $subjectClassTeachers;


    public function __construct() {
        parent::__construct();
        $this->studentSubjects = new \Doctrine\Common\Collections\ArrayCollection();
        $this->classTeachers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->subjectClassTeachers = new \Doctrine\Common\Collections\ArrayCollection();
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

    /**
     * Add classTeachers
     *
     * @param \WebDiaryBundle\Entity\Classes $classTeachers
     * @return User
     */
    public function addClassTeachers(\WebDiaryBundle\Entity\Classes $classTeachers)
    {
        $this->classTeachers[] = $classTeachers;

        return $this;
    }

    /**
     * Remove classTeachers
     *
     * @param \WebDiaryBundle\Entity\Classes $classTeachers
     */
    public function removeClassTeachers(\WebDiaryBundle\Entity\Classes $classTeachers)
    {
        $this->classTeachers->removeElement($classTeachers);
    }

    /**
     * Get classTeachers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getClassTeachers()
    {
        return $this->classTeachers;
    }

    /**
     * Add classTeachers
     *
     * @param \WebDiaryBundle\Entity\Classes $classTeachers
     * @return User
     */
    public function addClassTeacher(\WebDiaryBundle\Entity\Classes $classTeachers)
    {
        $this->classTeachers[] = $classTeachers;

        return $this;
    }

    /**
     * Remove classTeachers
     *
     * @param \WebDiaryBundle\Entity\Classes $classTeachers
     */
    public function removeClassTeacher(\WebDiaryBundle\Entity\Classes $classTeachers)
    {
        $this->classTeachers->removeElement($classTeachers);
    }

    /**
     * Add studentSubjectTeachers
     *
     * @param \WebDiaryBundle\Entity\Student_subjects $studentSubjectTeachers
     * @return User
     */
    public function addStudentSubjectTeacher(\WebDiaryBundle\Entity\Student_subjects $studentSubjectTeachers)
    {
        $this->studentSubjectTeachers[] = $studentSubjectTeachers;

        return $this;
    }

    /**
     * Remove studentSubjectTeachers
     *
     * @param \WebDiaryBundle\Entity\Student_subjects $studentSubjectTeachers
     */
    public function removeStudentSubjectTeacher(\WebDiaryBundle\Entity\Student_subjects $studentSubjectTeachers)
    {
        $this->studentSubjectTeachers->removeElement($studentSubjectTeachers);
    }

    /**
     * Get studentSubjectTeachers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStudentSubjectTeachers()
    {
        return $this->studentSubjectTeachers;
    }

    /**
     * Add studentSubjects
     *
     * @param \WebDiaryBundle\Entity\Student_subjects $studentSubjects
     * @return User
     */
    public function addStudentSubject(\WebDiaryBundle\Entity\Student_subjects $studentSubjects)
    {
        $this->studentSubjects[] = $studentSubjects;

        return $this;
    }

    /**
     * Remove studentSubjects
     *
     * @param \WebDiaryBundle\Entity\Student_subjects $studentSubjects
     */
    public function removeStudentSubject(\WebDiaryBundle\Entity\Student_subjects $studentSubjects)
    {
        $this->studentSubjects->removeElement($studentSubjects);
    }

    /**
     * Get studentSubjects
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStudentSubjects()
    {
        return $this->studentSubjects;
    }

    /**
     * Add subjectClassTeachers
     *
     * @param \WebDiaryBundle\Entity\Class_subjects $subjectClassTeachers
     * @return User
     */
    public function addSubjectClassTeacher(\WebDiaryBundle\Entity\Class_subjects $subjectClassTeachers)
    {
        $this->subjectClassTeachers[] = $subjectClassTeachers;

        return $this;
    }

    /**
     * Remove subjectClassTeachers
     *
     * @param \WebDiaryBundle\Entity\Class_subjects $subjectClassTeachers
     */
    public function removeSubjectClassTeacher(\WebDiaryBundle\Entity\Class_subjects $subjectClassTeachers)
    {
        $this->subjectClassTeachers->removeElement($subjectClassTeachers);
    }

    /**
     * Get subjectClassTeachers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSubjectClassTeachers()
    {
        return $this->subjectClassTeachers;
    }
}
