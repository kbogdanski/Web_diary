<?php

namespace WebDiaryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class_subjects
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Class_subjects
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
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="school_year", type="string", length=9)
     */
    private $schoolYear;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creation_date", type="datetime")
     */
    private $creationDate;
    
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="subjectClassTeachers")
     * @ORM\JoinColumn(name="teacher_id", referencedColumnName="id")
     */
    private $subjectTeacher;
    
    /**
     * @ORM\ManyToOne(targetEntity="Classes", inversedBy="classSubjects")
     * @ORM\JoinColumn(name="class_id", referencedColumnName="id")
     */
    private $class;
    
    /**
     * @ORM\ManyToOne(targetEntity="Subjects", inversedBy="classes")
     * @ORM\JoinColumn(name="subject_id", referencedColumnName="id")
     */
    private $subject;


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
     * Set description
     *
     * @param string $description
     * @return Class_subjects
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set schoolYear
     *
     * @param string $schoolYear
     * @return Class_subjects
     */
    public function setSchoolYear($schoolYear)
    {
        $this->schoolYear = $schoolYear;

        return $this;
    }

    /**
     * Get schoolYear
     *
     * @return string 
     */
    public function getSchoolYear()
    {
        return $this->schoolYear;
    }

    /**
     * Set creationDate
     *
     * @param \DateTime $creationDate
     * @return Class_subjects
     */
    public function setCreationDate()
    {
        $this->creationDate = new \DateTime();

        return $this;
    }

    /**
     * Get creationDate
     *
     * @return \DateTime 
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set subjectTeacher
     *
     * @param \WebDiaryBundle\Entity\User $subjectTeacher
     * @return Class_subjects
     */
    public function setSubjectTeacher(\WebDiaryBundle\Entity\User $subjectTeacher = null)
    {
        $this->subjectTeacher = $subjectTeacher;

        return $this;
    }

    /**
     * Get subjectTeacher
     *
     * @return \WebDiaryBundle\Entity\User 
     */
    public function getSubjectTeacher()
    {
        return $this->subjectTeacher;
    }

    /**
     * Set class
     *
     * @param \WebDiaryBundle\Entity\Classes $class
     * @return Class_subjects
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
     * Set subject
     *
     * @param \WebDiaryBundle\Entity\Subjects $subject
     * @return Class_subjects
     */
    public function setSubject(\WebDiaryBundle\Entity\Subjects $subject = null)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return \WebDiaryBundle\Entity\Subjects 
     */
    public function getSubject()
    {
        return $this->subject;
    }
}
