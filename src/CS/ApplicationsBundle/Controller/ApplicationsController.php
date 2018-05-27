<?php
/**
 * Created by PhpStorm.
 * User: dnid
 * Date: 13/06/17
 * Time: 16:41
 */

namespace CS\ApplicationsBundle\Controller;


use CS\ApplicationsBundle\Entity\Application;
use CS\ApplicationsBundle\Form\ApplicationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Twig\Extension\ExtensionInterface ;

class ApplicationsController extends Controller
{
    public function allAction($page){

        $maxArticles = $this->container->getParameter('max_item_per_page') ;

        $em = $this->getDoctrine()->getManager() ;

        $applicationRepository = $em->getRepository('CSApplicationsBundle:Application');

        $articles_count = count($applicationRepository->findAll());

        $pagination = array(
            'page' => $page,
            'route' => 'cs_applications_all',
            'pages_count' => ceil($articles_count / $maxArticles),
            'route_params' => array()
        );


        $datas = array(
            'liste_applications' => $applicationRepository->getList($page,$maxArticles),
            'pagination'  => $pagination) ;

        return $this->render('CSApplicationsBundle:Applications:all.html.twig',$datas);

    }

    public function newAction(Request $request){

        $em = $this->getDoctrine()->getManager() ;

        $application = new Application() ;

        $form = $this->get('form.factory')->create(ApplicationType::class,$application) ;


        if($request->isMethod(('POST'))){

            $form->handleRequest($request) ;

            if($form->isValid()){
                $em->persist($application) ;
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Nouvelle application créée avec succès.') ;
                return $this->redirectToRoute('cs_applications_all') ;
            }
            else{
                $request->getSession()->getFlashBag()->add('warning', 'Le formulaire a été mal renseigné, veuillez réessayer.') ;
            }

        }

        $datas = array(
            'form'        =>$form->createView()
        ) ;

        return $this->render('CSApplicationsBundle:Applications:new.html.twig',$datas);

    }

    public function viewAction(Request $request,$id){

        $em = $this->getDoctrine()->getManager() ;

        $applicationRepository = $em->getRepository('CSApplicationsBundle:Application');

        $application = $applicationRepository->find($id);

        $developpeur = $application->getIdDeveloppeur() ;

        $piecesJointes = $application->getIdFichier() ;

        $datas = array(
            'application'       =>$application,
            'developpeurs'      =>$developpeur,
            'piecesJointes'     =>$piecesJointes
        ) ;


        return $this->render('CSApplicationsBundle:Applications:view.html.twig',$datas);

    }

    public function editAcion(){

        return $this->render('CSApplicationsBundle:Applications:edit.html.twig');

    }

    public function deleteAction(){

        return $this->render('CSApplicationsBundle:Applications:all.html.twig');

    }
}