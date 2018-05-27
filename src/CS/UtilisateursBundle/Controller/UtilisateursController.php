<?php

namespace CS\UtilisateursBundle\Controller;

use CS\UtilisateursBundle\Entity\Utilisateur;
use CS\UtilisateursBundle\Form\UtilisateurType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UtilisateursController extends Controller
{
    public function allAction($page)
    {
        $maxArticles = $this->container->getParameter('max_users_per_page') ;

        $em = $this->getDoctrine()->getManager() ;

        $utilisateursRepository = $em->getRepository('CSUtilisateursBundle:Utilisateur');


        $articles_count = count($utilisateursRepository->findAll());

        $pagination = array(
            'page' => $page,
            'route' => 'cs_utilisateurs_all',
            'pages_count' => ceil($articles_count / $maxArticles),
            'route_params' => array()
        );


        $datas = array(
            'liste_users' => $utilisateursRepository->getList($page,$maxArticles),
            'pagination'  => $pagination) ;

        return $this->render('CSUtilisateursBundle:Utilisateurs:all.html.twig',$datas);
    }


    public function newAction(Request $request){

        $em = $this->getDoctrine()->getManager() ;

        $utilisateur = new Utilisateur() ;

        $form = $this->get('form.factory')->create(UtilisateurType::class,$utilisateur) ;


        if($request->isMethod(('POST'))){

            $form->handleRequest($request) ;

            if($form->isValid()){
                $em->persist($utilisateur) ;
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Nouvel utilisateur créé avec succès.') ;
                return $this->redirectToRoute('cs_utilisateurs_all') ;
            }
            else{
                $request->getSession()->getFlashBag()->add('warning', 'Le formulaire a été mal renseigné, veuillez réessayer.') ;
            }

        }

        $datas = array(
            'form'        =>$form->createView()
        ) ;

        return $this->render('CSUtilisateursBundle:Utilisateurs:new.html.twig',$datas);

    }

    public function editAction(Request $request, $id){

        $em = $this->getDoctrine()->getManager() ;

        $utilisateurRepository = $em->getRepository('CSUtilisateursBundle:Utilisateur');

        $utilisateur = $utilisateurRepository->find($id);

        $oldPassword = $utilisateur->getMdp() ;

        $form = $this->get('form.factory')->create(UtilisateurType::class,$utilisateur) ;


        if($request->isMethod(('POST'))){

            $form->handleRequest($request) ;

            if($form->isValid()){
                $utilisateur->setMdp($oldPassword) ;
                $em->persist($utilisateur) ;
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Les modifications ont été sauvegardées avec succès.') ;
            }
            else{
                $request->getSession()->getFlashBag()->add('warning', 'Le formulaire a été mal renseigné, veuillez réessayer.') ;
            }
        }

        $datas = array(
            'form'        =>$form->createView()
        ) ;

        return $this->render('CSUtilisateursBundle:Utilisateurs:view.html.twig',$datas);
    }


    public function deleteAction(Request $request,$id){

        $em = $this->getDoctrine()->getManager() ;
        $utilisateurRepository = $em->getRepository('CSUtilisateursBundle:Utilisateur');
        $utilisateur = $utilisateurRepository->find($id);

        if(!$utilisateur){
            $request->getSession()->getFlashBag()->add('warning', "Erreur fatale : l'utilisateur n'exite pas!") ;
        }

        else{
            $em->remove($utilisateur) ;
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', "L'utilisateur a été supprimé avec succès.") ;
        }

        return $this->redirectToRoute('cs_utilisateurs_all') ;

    }
}
