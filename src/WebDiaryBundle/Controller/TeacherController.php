<?php

namespace WebDiaryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use WebDiaryBundle\Form\Type\ClassType;
use WebDiaryBundle\Form\Type\SubjectType;
use WebDiaryBundle\Entity\Classes;
use WebDiaryBundle\Entity\Subjects;
use WebDiaryBundle\Entity\User;
use WebDiaryBundle\Entity\Student_subjects;
use WebDiaryBundle\Entity\Student_subjectsRepository;
use WebDiaryBundle\Entity\Class_subjects;
use WebDiaryBundle\Entity\Rate_student_subject;
use WebDiaryBundle\Entity\Description_rates;




class TeacherController extends Controller {
    
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction() {
        $user = $this->container->get('security.context')->getToken()->getUser();
        
        $rep = $this->getDoctrine()->getRepository('WebDiaryBundle:Classes');
        $myClasses = $rep->findByTeacher($user->getId());
        
        if (!$myClasses) {
            $myClasses = 'Brak klas dla których jesteś wychowawdzą';
        }
        
        return array('user' => $user, 'myClasses' => $myClasses);
    }

    

    /**
     * @Route("/teacher/addClass")
     * @Template()
     */
    public function addClassAction(Request $req) {
        $class = new Classes();
        $form = $this->createForm(new ClassType(), $class);
        $form->handleRequest($req);
        
        if ($req->getMethod() === 'POST') {
            if ($form->isSubmitted() && $form->isValid()) {
                $class = $form->getData();
                $class->setCreationDate();
                $user = $this->container->get('security.context')->getToken()->getUser();
                $class->setTeacher($user);
                
                $em = $this->getDoctrine()->getManager();
                $em->persist($class);
                $em->flush();

                return $this->redirectToRoute('webdiary_teacher_index');
            }
        }
        return array('form' => $form->createView());
    }
    
    
    /**
     * @Route("/teacher/addSubject")
     * @Template()
     */
    public function addSubject(Request $req) {
        $subject = new Subjects();
        $form = $this->createForm(new SubjectType(), $subject);
        $form->handleRequest($req);
        
        if ($req->getMethod() === 'POST') {
            if ($form->isSubmitted() && $form->isValid()) {
                $subject = $form->getData();
                $subject->setCreationDate();
                
                $em = $this->getDoctrine()->getManager();
                $em->persist($subject);
                $em->flush();

                return $this->redirectToRoute('webdiary_teacher_index');
            }
        }
        return array('form' => $form->createView());
    }
    
    
    /**
     * @Route("/teacher/myClass/{id}")
     * @Template()
     */
    public function showMyClassAction(Request $req, $id) {
        $rep = $this->getDoctrine()->getRepository('WebDiaryBundle:Classes');
        $myClass = $rep->find($id);
        
        $formSubjectToClass = $this->formSubjectToClass();
        $formSubjectToClass->handleRequest($req);
        
        $formStudentToClass = $this->formStudentToClass();
        $formStudentToClass->handleRequest($req);
        
        if ($req->getMethod() === 'POST') {
            if ($formSubjectToClass->isSubmitted() && $formSubjectToClass->isValid()) {
                $this->addSubjectToClass($formSubjectToClass, $myClass);
                return $this->redirectToRoute('webdiary_teacher_showmyclass', array('id' => $id));
            }

            if ($formStudentToClass->isSubmitted() && $formStudentToClass->isValid()) {
                $this->addStudentToClass($formStudentToClass, $myClass);
                return $this->redirectToRoute('webdiary_teacher_showmyclass', array('id' => $id));
            }
        }
        return array('myClass' => $myClass, 'formSubjectToClass' => $formSubjectToClass->createView(), 'formStudentToClass' => $formStudentToClass->createView());
    }
    
    
    /**
     * @Route("/teacher/subject/{idClass}/{idSubject}")
     * @Template()
     */
    public function showSubjectAction(Request $req, $idClass, $idSubject) {
        $repClass = $this->getDoctrine()->getRepository('WebDiaryBundle:Classes');
        $class = $repClass->find($idClass);
        
        $repSubject = $this->getDoctrine()->getRepository('WebDiaryBundle:Subjects');
        $subject = $repSubject->find($idSubject);
        
        $rep = $this->getDoctrine()->getRepository('WebDiaryBundle:Student_subjects');
        $studentSubjects = $rep->getSubjectClassStudents($idSubject, $idClass);
        
        return array('class' => $class, 'subject' => $subject, 'studentSubjects' => $studentSubjects);
    }
    
    /**
     * @Route("/teacher/addRateToStudent")
     * @Template()
     */
    public function addRateToStudentAction(Request $req) {
        $rate = $req->request->get('rate');
        $description = $req->request->get('description');
        $id = $req->request->get('id');
        
        $repStudentSubject = $this->getDoctrine()->getRepository('WebDiaryBundle:Student_subjects');
        $studentSubject = $repStudentSubject->findOneById($id);
        
        $rep = $this->getDoctrine()->getRepository('WebDiaryBundle:Description_rates');
        $descriptionRate = $rep->findOneByRate($rate);
        
        $newRate = new Rate_student_subject();
        $newRate->setDate();
        $newRate->setRate($rate);
        $newRate->setDescription($description);
        $newRate->setStudentSubject($studentSubject);
        $newRate->setDescriptionRate($descriptionRate);
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($newRate);
        $em->flush();
        
        return new JsonResponse(array('rate' => $rate, 'description' => $description));
    }





    //PRIVATE FUNCTION
    private function addSubjectToClass($formSubjectToClass, $myClass) {
        $data = $formSubjectToClass->getData();
        $addSubject = $data['subject'];
        $addTeacher = $data['teacher'];
        $addSchoolYear = $data['school_year'];

        $subjectInClass = $myClass->getClassSubjects();
        $flag = 1;
        foreach ($subjectInClass as $subject) {
            if ($subject->getId() == $addSubject->getId()) {
                $flag = 0;
                break;
            }
        }
        
        if ($flag) {
            $countStudents = count($myClass->getStudents());
            if ($countStudents > 0) {
                $classStudents = $myClass->getStudents();
                for ($i=0; $i<$countStudents; $i++) {
                    $studentSubject = new Student_subjects();
                    $studentSubject->setStudent($classStudents[$i]);
                    $studentSubject->setSubject($addSubject);
                    $studentSubject->setCreationDate();

                    $em = $this->getDoctrine()->getManager();
                    $em->persist($studentSubject);
                    $em->flush();
                }
            }
            
            $classSubject = new Class_subjects();
            $classSubject->setSubjectTeacher($addTeacher);
            $classSubject->setClass($myClass);
            $classSubject->setSubject($addSubject);
            $classSubject->setSchoolYear($addSchoolYear);
            $classSubject->setCreationDate();
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($classSubject);
            $em->flush();
        }
    }
    
    private function addStudentToClass($formStudentToClass, $myClass) {
        $data = $formStudentToClass->getData();
        $addStudent = $data['student'];

        $studentInClass = $myClass->getStudents();
        $flag = 1;
        foreach ($studentInClass as $student) {
            if ($student->getId() == $addStudent->getId()) {
                $flag = 0;
                break;
            }
        }
        
        if ($flag) {
            $countSubjects = count($myClass->getClassSubjects());
            if ($countSubjects > 0) {
                $classSubjects = $myClass->getClassSubjects();
                for ($i=0; $i<$countSubjects; $i++) {
                    $studentSubject = new Student_subjects();
                    $studentSubject->setStudent($addStudent);
                    $studentSubject->setSubject($classSubjects[$i]->getSubject());
                    $studentSubject->setCreationDate();

                    $em = $this->getDoctrine()->getManager();
                    $em->persist($studentSubject);
                    $em->flush();
                }
            }

            $addStudent->setClass($myClass);
            $em = $this->getDoctrine()->getManager();
            $em->persist($addStudent);
            $em->flush();
        }
    }
    
    private function findDescriptionRate($rate) {
        $rep = $this->getDoctrine()->getRepository('WebDiaryBundle:Description_rates');
        $descriptionRate = $rep->findByRate($rate);
        
        if (isset($descriptionRate)) {
            return $descriptionRate;
        }
        
        return new Description_rates();
    }

    

    //FORMULARZE
    private function formSubjectToClass() {
        $formSubjectToClass = $this->createFormBuilder()
            ->add('subject', 'entity', array('class' => 'WebDiaryBundle:Subjects', 'choice_label' => 'name', 'label' => 'Dodaj przedmiot do klasy: '))
            ->add('teacher', 'entity', array('class' => 'WebDiaryBundle:User', 'choice_label' => 'username', 'label' => 'Nauczyciel przedmiotu: '))
            ->add('school_year', 'text', array('label' => 'ROK SZKOLNY (np. 2016/2017): '))
            ->add('save', 'submit', array('label' => 'Dodaj'))
            ->getForm();
       return  $formSubjectToClass;
    }
    
    private function formStudentToClass() {
        $formStudentToClass = $this->createFormBuilder()
            ->add('student', 'entity', array('class' => 'WebDiaryBundle:User', 'choice_label' => 'username', 'label' => 'Dodaj ucznia do klasy: '))
            ->add('save', 'submit', array('label' => 'Dodaj'))
            ->getForm();
        return $formStudentToClass;
    }
    
    
}
