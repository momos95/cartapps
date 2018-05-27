<?php
/**
 * Created by PhpStorm.
 * User: dnid
 * Date: 10/07/17
 * Time: 15:13
 */

namespace CS\ApplicationsBundle\Controller;


use CS\ApplicationsBundle\Entity\TypeBase;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TypeBasesController extends Controller
{

    public function allAction($page)
    {
        $maxArticles = $this->container->getParameter('max_item_per_page') ;

        $em = $this->getDoctrine()->getManager() ;

        $basesRepository = $em->getRepository('CSApplicationsBundle:TypeBase');

        $articles_count = count($basesRepository->findAll());

        $pagination = array(
            'page' => $page,
            'route' => 'cs_bases_all',
            'pages_count' => ceil($articles_count / $maxArticles),
            'route_params' => array()
        );


        $datas = array(
            'liste_bases' => $basesRepository->getList($page,$maxArticles),
            'pagination'  => $pagination) ;

        return $this->render('CSApplicationsBundle:TypeBases:all.html.twig',$datas);
    }


    public function newAction(Request $request){


        $em = $this->getDoctrine()->getManager() ;
        $typeRepository = $em->getRepository('CSApplicationsBundle:TypeBase');
        $type = new TypeBase() ;

        if($request->isMethod('POST')){

            $libelle = $request->get('libType');

            if(empty($libelle)){
                $request->getSession()->getFlashBag()->add('warning', 'Le libellé ne doit pas être nul !') ;
            }
            elseif ($typeRepository->findByLibType($libelle)){
                $request->getSession()->getFlashBag()->add('warning', 'Ce type de BDD existe déjà.') ;
            }
            else{
                $type->setLibType($libelle) ;
                $em->persist($type);
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Un nouveau type de base de données a été ajouté.') ;
            }
        }

        return $this->redirectToRoute('cs_bases_all') ;

    }

    public function editAction(Request $request, $id){

        $em = $this->getDoctrine()->getManager() ;
        $typeRepository = $em->getRepository('CSApplicationsBundle:TypeBase');

        $type = $typeRepository->find($id);

        if($request->isMethod('POST')){

            $libelle = $request->get('libType');

            if(empty($libelle)){
                $request->getSession()->getFlashBag()->add('warning', 'Le libellé ne doit pas être nul !') ;
            }
            elseif ($typeRepository->findByLibType($libelle) && $libelle != $type->getLibType()){
                $request->getSession()->getFlashBag()->add('warning', 'Ce type de BDD existe déjà.') ;
            }
            else{
                $type->setLibType($libelle) ;
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Le type de base de données a été modifié avec succès.') ;
            }
        }

        return $this->redirectToRoute('cs_bases_all') ;
    }


    public function deleteAction(Request $request,$id){

        $em = $this->getDoctrine()->getManager() ;
        $typeRepository = $em->getRepository('CSApplicationsBundle:TypeBase');
        $type = $typeRepository->find($id);

        if(!$type){
            $request->getSession()->getFlashBag()->add('warning', "Erreur fatale : le type de BDD n'exite pas!") ;
        }

        else{
            $em->remove($type) ;
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'Le type de BDD a été supprimé avec succès.') ;
        }

        return $this->redirectToRoute('cs_bases_all') ;

    }


}