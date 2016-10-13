<?php

namespace WebDiaryBundle\Entity;

use Doctrine\ORM\EntityRepository;


class Student_subjectsRepository extends EntityRepository {
    
    public function getSubjectClassStudents($idSubject, $idClass) {
        $em = $this->getEntityManager();

        $query = $em->createQuery(
            "SELECT ss
            FROM WebDiaryBundle:Student_subjects ss JOIN ss.student student
            WITH student.class = '$idClass' AND ss.subject = '$idSubject'");

        return $query->getResult();
    }
    
    
    
}