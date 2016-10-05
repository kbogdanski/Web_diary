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

                return $this->redirectToRoute('fos_user_profile_show');
            }
        }
        return array('form' => $form->createView());
    }
    
    
    /**
     * @Route("/teacher/myClass")
     * @Template()
     */
    public function showMyClassAction() {
        
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

                return $this->redirectToRoute('fos_user_profile_show');
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
