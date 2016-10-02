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
    private $studentSubjectHasThisRate;
    

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
        $this->studentSubjectHasThisRate = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add studentSubjectHasThisRate
     *
     * @param \WebDiaryBundle\Entity\Rate_student_subjects $studentSubjectHasThisRate
     * @return Description_rates
     */
    public function addStudentSubjectHasThisRate(\WebDiaryBundle\Entity\Rate_student_subjects $studentSubjectHasThisRate)
    {
        $this->studentSubjectHasThisRate[] = $studentSubjectHasThisRate;

        return $this;
    }

    /**
     * Remove studentSubjectHasThisRate
     *
     * @param \WebDiaryBundle\Entity\Rate_student_subjects $studentSubjectHasThisRate
     */
    public function removeStudentSubjectHasThisRate(\WebDiaryBundle\Entity\Rate_student_subjects $studentSubjectHasThisRate)
    {
        $this->studentSubjectHasThisRate->removeElement($studentSubjectHasThisRate);
    }

    /**
     * Get studentSubjectHasThisRate
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStudentSubjectHasThisRate()
    {
        return $this->studentSubjectHasThisRate;
    }
}
