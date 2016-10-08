<?php

namespace WebDiaryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use WebDiaryBundle\Form\Type\ClassType;
use WebDiaryBundle\Form\Type\SubjectType;
use WebDiaryBundle\Entity\Classes;
use WebDiaryBundle\Entity\Subjects;
use WebDiaryBundle\Entity\User;
use WebDiaryBundle\Entity\Student_subjects;




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
     * @Route("/teacher/myClass/{id}")
     * @Template()
     */
    public function showMyClassAction(Request $req, $id) {
        $rep = $this->getDoctrine()->getRepository('WebDiaryBundle:Classes');
        $myClass = $rep->find($id);
        
        $formSubjects = $this->createFormBuilder()
            ->add('subject', 'entity', array('class' => 'WebDiaryBundle:Subjects', 'choice_label' => 'name', 'label' => 'Dodaj przedmiot do klasy: '))
            ->add('save', 'submit', array('label' => 'Dodaj'))
            ->getForm();
        $formSubjects->handleRequest($req);
        
        $formStudents = $this->createFormBuilder()
            ->add('student', 'entity', array('class' => 'WebDiaryBundle:User', 'choice_label' => 'username', 'label' => 'Dodaj ucznia do klasy: '))
            ->add('save', 'submit', array('label' => 'Dodaj'))
            ->getForm();
        $formStudents->handleRequest($req);
        
        if ($req->getMethod() === 'POST') {
            if ($formSubjects->isSubmitted() && $formSubjects->isValid()) {
                $data = $formSubjects->getData();
                $addSubject = $data['subject'];
                
                $countStudents = count($myClass->getStudents());
                
                if ($countStudents > 0) {
                    $classStudents = $myClass->getStudents();
                    for ($i=0; $i<$countStudents; $i++) {
                        $studentSubject = new Student_subjects();
                        $studentSubject->setStudent($classStudents[$i]);
                        $studentSubject->setSubject($addSubject);
                        
                        $em = $this->getDoctrine()->getManager();
                        $em->persist($studentSubject);
                        $em->flush();
                    }
                }
                
                $myClass->addSubject($addSubject);
                $em = $this->getDoctrine()->getManager();
                $em->persist($myClass);
                $em->flush();

                return $this->render('WebDiaryBundle:Teacher:showMyClass.html.twig', 
                        array('myClass' => $myClass, 'formSubjects' => $formSubjects->createView(), 'formStudents' => $formStudents->createView()));
            }

            if ($formStudents->isSubmitted() && $formStudents->isValid()) {
                $data = $formStudents->getData();
                $addStudent = $data['student'];

                $countSubjects = count($myClass->getSubjects());
                
                if ($countSubjects > 0) {
                    $classSubjects = $myClass->getSubjects();
                    for ($i=0; $i<$countSubjects; $i++) {
                        $studentSubject = new Student_subjects();
                        $studentSubject->setStudent($addStudent);
                        $studentSubject->setSubject($classSubjects[$i]);
                        
                        $em = $this->getDoctrine()->getManager();
                        $em->persist($studentSubject);
                        $em->flush();
                    }
                }
                
                $addStudent->setClass($myClass);
                $em = $this->getDoctrine()->getManager();
                $em->persist($addStudent);
                $em->flush();
                
                return $this->render('WebDiaryBundle:Teacher:showMyClass.html.twig', 
                        array('myClass' => $myClass, 'formSubjects' => $formSubjects->createView(), 'formStudents' => $formStudents->createView()));
            }
           
            

        }
        
        
        return array('myClass' => $myClass, 'formSubjects' => $formSubjects->createView(), 'formStudents' => $formStudents->createView());
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
     * @Route("/teacher/addSubjectToClass")
     * @Template()
     */
    public function addSubjectToClassAction() {
        
    }
    
}
