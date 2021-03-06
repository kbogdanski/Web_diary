<?php

namespace WebDiaryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description_rates
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Description_rates
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
     * @ORM\Column(name="description", type="string", length=20)
     */
    private $description;

    
    /**
     * @ORM\OneToMany(targetEntity="Rate_student_subject", mappedBy="descriptionRate")
     */
    private $studentSubjectHasThisRates;
    

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
     * @return Description_rates
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
     * @return Description_rates
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
     * Constructor
     */
    public function __construct()
    {
        $this->studentSubjectHasThisRates = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add studentSubjectHasThisRates
     *
     * @param \WebDiaryBundle\Entity\Rate_student_subjects $studentSubjectHasThisRates
     * @return Description_rates
     */
    public function addStudentSubjectHasThisRates(\WebDiaryBundle\Entity\Rate_student_subject $studentSubjectHasThisRates)
    {
        $this->studentSubjectHasThisRates[] = $studentSubjectHasThisRates;

        return $this;
    }

    /**
     * Remove studentSubjectHasThisRates
     *
     * @param \WebDiaryBundle\Entity\Rate_student_subjects $studentSubjectHasThisRates
     */
    public function removeStudentSubjectHasThisRates(\WebDiaryBundle\Entity\Rate_student_subject $studentSubjectHasThisRates)
    {
        $this->studentSubjectHasThisRates->removeElement($studentSubjectHasThisRates);
    }


    /**
     * Get studentSubjectHasThisRates
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStudentSubjectHasThisRates()
    {
        return $this->studentSubjectHasThisRates;
    }
}
