<?php
/**
 * Created by PhpStorm.
 * User: dnid
 * Date: 13/06/17
 * Time: 18:06
 */

namespace CS\ServeursBundle\Controller;


use CS\ServeursBundle\Entity\Serveur;
use CS\ServeursBundle\Form\ServeurType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ServeursController extends Controller
{
    public function allAction($page){

        $maxArticles = $this->container->getParameter('max_item_per_page') ;

        $em = $this->getDoctrine()->getManager() ;

        $serveurRepository = $em->getRepository('CSServeursBundle:Serveur');

        $articles_count = count($serveurRepository->findAll());

        $pagination = array(
            'page' => $page,
            'route' => 'cs_serveurs_all',
            'pages_count' => ceil($articles_count / $maxArticles),
            'route_params' => array()
        );


        $datas = array(
            'liste_serveurs' => $serveurRepository->getList($page,$maxArticles),
            'pagination'  => $pagination) ;

        return $this->render('CSServeursBundle:Serveurs:all.html.twig',$datas);

    }

    public function newAction(Request $request){

        $em = $this->getDoctrine()->getManager() ;

        $serveur = new Serveur() ;

        $form = $this->get('form.factory')->create(ServeurType::class,$serveur) ;


        if($request->isMethod(('POST'))){

            $form->handleRequest($request) ;

            if($form->isValid()){
                $em->persist($serveur) ;
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Nouveau serveur créé avec succès.') ;
                return $this->redirectToRoute('cs_serveurs_all') ;
            }
            else{
                $request->getSession()->getFlashBag()->add('warning', 'Le formulaire a été mal renseigné, veuillez réessayer.') ;
            }

        }

        $datas = array(
            'form'        =>$form->createView()
        ) ;

        return $this->render('CSServeursBundle:Serveurs:new.html.twig',$datas);

    }

    public function editAction(Request $request,$id){

        $em = $this->getDoctrine()->getManager() ;

        $serveurRepository = $em->getRepository('CSServeursBundle:Serveur');

        $serveur = $serveurRepository->find($id);

        $form = $this->get('form.factory')->create(ServeurType::class,$serveur) ;


        if($request->isMethod(('POST'))){

            $form->handleRequest($request) ;

            if($form->isValid()){
                $em->persist($serveur) ;
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Les modifications ont été sauvegardées avec succès.') ;
            }
            else{
                $request->getSession()->getFlashBag()->add('warning', 'Le formulaire a été mal renseigné, veuillez réessayer.') ;
            }
        }

        $datas = array(
            'serveur'     =>$serveur,
            'form'        =>$form->createView()
        ) ;

        return $this->render('CSServeursBundle:Serveurs:edit.html.twig',$datas);

    }

    public function viewAction(Request $request,$id){

        $em = $this->getDoctrine()->getManager() ;

        $serveurRepository = $em->getRepository('CSServeursBundle:Serveur');

        $serveur = $serveurRepository->find($id);

        $datas = array(
            'serveur'     =>$serveur
        ) ;

        return $this->render('CSServeursBundle:Serveurs:view.html.twig',$datas);

    }

    public function deleteAction(Request $request,$id){

        $em = $this->getDoctrine()->getManager() ;
        $serveurRepository = $em->getRepository('CSServeursBundle:Serveur');
        $serveur = $serveurRepository->find($id);

        if(!$serveur){
            $request->getSession()->getFlashBag()->add('warning', "Erreur fatale : le serveur n'exite pas!") ;
        }

        else{
            $em->remove($serveur) ;
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', "Le serveur a été supprimé avec succès.") ;
        }

        return $this->redirectToRoute('cs_serveurs_all') ;

    }


    public function appsAction($id,$page){

        $maxArticles = $this->container->getParameter('max_item_per_page') ;

        $em = $this->getDoctrine()->getManager() ;

        $serveurRepository = $em->getRepository('CSServeursBundle:Serveur');

        $applicationRepository = $em->getRepository('CSApplicationsBundle:Application');

        $serveur = $serveurRepository->find($id);

        $listeAppliProd = $applicationRepository->findByServeurProd($serveur) ;

        $listeAppliDev = $applicationRepository->findByServeurDev($serveur) ;

        $listeApplications = array_merge($listeAppliProd,$listeAppliDev) ;

        $articles_count = count($listeApplications);

        $pagination = array(
            'page' => $page,
            'route' => 'cs_serveurs_apps',
            'pages_count' => ceil($articles_count / $maxArticles),
            'route_params' => array('id'=>$id)
        );

        $listeApplications = array_slice($listeApplications, ($page-1)*$maxArticles, $maxArticles);

        $datas = array(
            'serveur'               => $serveur,
            'liste_applications'    => $listeApplications,
            'pagination'            => $pagination
        );
        return $this->render('CSServeursBundle:Serveurs:view_apps.html.twig',$datas);
    }

}