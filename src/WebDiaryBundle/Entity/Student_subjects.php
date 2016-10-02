<?php

namespace WebDiaryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Student_subjects
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Student_subjects
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
    private $schoolYear ;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creation_date", type="datetime")
     */
    private $creationDate;

    
    /**
     * @ORM\OneToMany(targetEntity="Rate_student_subject", mappedBy="studentSubject")
     */
    private $rates;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="subjects")
     * @ORM\JoinColumn(name="student_id", referencedColumnName="id")
     */
    private $student;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="Subjects", inversedBy="students")
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
     * @return Student_subjects
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
     * Set creationDate
     *
     * @param \DateTime $creationDate
     * @return Student_subjects
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

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
     * Set student
     *
     * @param \WebDiaryBundle\Entity\User $student
     * @return Student_subjects
     */
    public function setStudent(\WebDiaryBundle\Entity\User $student = null)
    {
        $this->student = $student;

        return $this;
    }

    /**
     * Get student
     *
     * @return \WebDiaryBundle\Entity\User 
     */
    public function getStudent()
    {
        return $this->student;
    }

    /**
     * Set subject
     *
     * @param \WebDiaryBundle\Entity\Subjects $subject
     * @return Student_subjects
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
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->rates = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add rates
     *
     * @param \WebDiaryBundle\Entity\Rate_student_subjects $rates
     * @return Student_subjects
     */
    public function addRate(\WebDiaryBundle\Entity\Rate_student_subjects $rates)
    {
        $this->rates[] = $rates;

        return $this;
    }

    /**
     * Remove rates
     *
     * @param \WebDiaryBundle\Entity\Rate_student_subjects $rates
     */
    public function removeRate(\WebDiaryBundle\Entity\Rate_student_subjects $rates)
    {
        $this->rates->removeElement($rates);
    }

    /**
     * Get rates
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRates()
    {
        return $this->rates;
    }

    /**
     * Set schoolYear
     *
     * @param string $schoolYear
     * @return Student_subjects
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
}
