<?php

namespace CS\UtilisateursBundle\Controller;

use CS\UtilisateursBundle\Entity\Fonction;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class FonctionsController extends Controller
{

    public function allAction($page)
    {
        $maxArticles = $this->container->getParameter('max_item_per_page') ;

        $em = $this->getDoctrine()->getManager() ;

        $fonctionsRepository = $em->getRepository('CSUtilisateursBundle:Fonction');

        $articles_count = count($fonctionsRepository->findAll());

        $pagination = array(
            'page' => $page,
            'route' => 'cs_fonctions_all',
            'pages_count' => ceil($articles_count / $maxArticles),
            'route_params' => array()
        );


        $datas = array(
            'liste_fonctions' => $fonctionsRepository->getList($page,$maxArticles),
            'pagination'  => $pagination) ;

        return $this->render('CSUtilisateursBundle:Fonction:all.html.twig',$datas);
    }

    public function newAction(Request $request){


        $em = $this->getDoctrine()->getManager() ;
        $fonctionsRepository = $em->getRepository('CSUtilisateursBundle:Fonction');
        $fonction = new Fonction() ;

        if($request->isMethod('POST')){

            $libelle = $request->get('libFonction');

            if(empty($libelle)){
                $request->getSession()->getFlashBag()->add('warning', 'Le libellé ne doit pas être nul !') ;
            }
            elseif ($fonctionsRepository->findByLibFonction($libelle)){
                $request->getSession()->getFlashBag()->add('warning', 'Cette fonction existe déjà.') ;
            }
            else{
                $fonction->setLibFonction($libelle) ;
                $em->persist($fonction);
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Une nouvelle fonction a été créée.') ;
            }
        }

        return $this->redirectToRoute('cs_fonctions_all') ;

    }

    public function editAction(Request $request, $id){

        $em = $this->getDoctrine()->getManager() ;
        $fonctionsRepository = $em->getRepository('CSUtilisateursBundle:Fonction');

        $fonction = $fonctionsRepository->find($id);

        if($request->isMethod('POST')){

            $libelle = $request->get('libFonction');

            if(empty($libelle)){
                $request->getSession()->getFlashBag()->add('warning', 'Le libellé ne doit pas être nul !') ;
            }
            elseif ($fonctionsRepository->findByLibFonction($libelle) && $libelle != $fonction->getLibFonction()){
                $request->getSession()->getFlashBag()->add('warning', 'Cette fonction existe déjà.') ;
            }
            else{
                $fonction->setLibFonction($libelle) ;
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'La fonction a été modifiée avec succès.') ;
            }
        }

        return $this->redirectToRoute('cs_fonctions_all') ;
    }

    public function deleteAction(Request $request,$id){

        $em = $this->getDoctrine()->getManager() ;
        $fonctionsRepository = $em->getRepository('CSUtilisateursBundle:Fonction');
        $fonction = $fonctionsRepository->find($id);

        if(!$fonction){
            $request->getSession()->getFlashBag()->add('warning', "Erreur fatale : la fonction n'exite pas!") ;
        }

        else{
            $em->remove($fonction) ;
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'La fonction a été supprimée avec succès.') ;
        }

        return $this->redirectToRoute('cs_fonctions_all') ;

    }
}
