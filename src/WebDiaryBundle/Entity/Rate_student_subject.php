<?php

namespace WebDiaryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rate_student_subject
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Rate_student_subject
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
     * @var integer
     *
     * @ORM\Column(name="rate", type="integer")
     */
    private $rate;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="Student_subjects", inversedBy="rates")
     * @ORM\JoinColumn(name="student_subject_id", referencedColumnName="id")
     */
    private $studentSubject;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="Description_rates", inversedBy="studentSubjectHasThisRates")
     * @ORM\JoinColumn(name="description_rate_id", referencedColumnName="id")
     */
    private $descriptionRate;


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
     * Set rate
     *
     * @param integer $rate
     * @return Rate_student_subject
     */
    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get rate
     *
     * @return integer 
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Rate_student_subject
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
     * Set date
     *
     * @param \DateTime $date
     * @return Rate_student_subject
     */
    public function setDate()
    {
        $this->date = new \Date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set studentSubject
     *
     * @param \WebDiaryBundle\Entity\Student_subjects $studentSubject
     * @return Rate_student_subject
     */
    public function setStudentSubject(\WebDiaryBundle\Entity\Student_subjects $studentSubject = null)
    {
        $this->studentSubject = $studentSubject;

        return $this;
    }

    /**
     * Get studentSubject
     *
     * @return \WebDiaryBundle\Entity\Student_subjects 
     */
    public function getStudentSubject()
    {
        return $this->studentSubject;
    }

    /**
     * Set descriptionRate
     *
     * @param \WebDiaryBundle\Entity\Description_rates $descriptionRate
     * @return Rate_student_subject
     */
    public function setDescriptionRate(\WebDiaryBundle\Entity\Description_rates $descriptionRate = null)
    {
        $this->descriptionRate = $descriptionRate;

        return $this;
    }

    /**
     * Get descriptionRate
     *
     * @return \WebDiaryBundle\Entity\Description_rates 
     */
    public function getDescriptionRate()
    {
        return $this->descriptionRate;
    }
}
