<?php

namespace WebDiaryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Classes
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Classes
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
     * @ORM\Column(name="title", type="string", length=5)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creation_date", type="datetime")
     */
    private $creationDate;
    
    
    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="class")
     */
    private $students;
    
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="classTeachers")
     * @ORM\JoinColumn(name="teacher_id", referencedColumnName="id")
     */
    private $teacher;
    
    
    /**
     * @ORM\OneToMany(targetEntity="Class_subjects", mappedBy="class")
     */
    private $classSubjects;


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
     * Set title
     *
     * @param string $title
     * @return Classes
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Classes
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
     * @return Classes
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
     * Constructor
     */
    public function __construct()
    {
        $this->students = new \Doctrine\Common\Collections\ArrayCollection();
        $this->classSubjects = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add students
     *
     * @param \WebDiaryBundle\Entity\User $students
     * @return Classes
     */
    public function addStudent(\WebDiaryBundle\Entity\User $students)
    {
        $this->students[] = $students;

        return $this;
    }

    /**
     * Remove students
     *
     * @param \WebDiaryBundle\Entity\User $students
     */
    public function removeStudent(\WebDiaryBundle\Entity\User $students)
    {
        $this->students->removeElement($students);
    }

    /**
     * Get students
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStudents()
    {
        return $this->students;
    }


    /**
     * Set teacher
     *
     * @param \WebDiaryBundle\Entity\User $teacher
     * @return Classes
     */
    public function setTeacher(\WebDiaryBundle\Entity\User $teacher = null)
    {
        $this->teacher = $teacher;

        return $this;
    }

    /**
     * Get teacher
     *
     * @return \WebDiaryBundle\Entity\User 
     */
    public function getTeacher()
    {
        return $this->teacher;
    }

    /**
     * Add classSubjects
     *
     * @param \WebDiaryBundle\Entity\Class_subjects $classSubjects
     * @return Classes
     */
    public function addClassSubject(\WebDiaryBundle\Entity\Class_subjects $classSubjects)
    {
        $this->classSubjects[] = $classSubjects;

        return $this;
    }

    /**
     * Remove classSubjects
     *
     * @param \WebDiaryBundle\Entity\Class_subjects $classSubjects
     */
    public function removeClassSubject(\WebDiaryBundle\Entity\Class_subjects $classSubjects)
    {
        $this->classSubjects->removeElement($classSubjects);
    }

    /**
     * Get classSubjects
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getClassSubjects()
    {
        return $this->classSubjects;
    }
}
