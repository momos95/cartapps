<?php
/**
 * Created by PhpStorm.
 * User: dnid
 * Date: 11/07/17
 * Time: 14:45
 */

namespace CS\ApplicationsBundle\Controller;


use CS\ApplicationsBundle\Entity\Technologie;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TechnologiesController extends Controller
{

    public function allAction($page)
    {
        $maxArticles = $this->container->getParameter('max_item_per_page') ;

        $em = $this->getDoctrine()->getManager() ;

        $technologiesRepository = $em->getRepository('CSApplicationsBundle:Technologie');

        $articles_count = count($technologiesRepository->findAll());

        $pagination = array(
            'page' => $page,
            'route' => 'cs_technologies_all',
            'pages_count' => ceil($articles_count / $maxArticles),
            'route_params' => array()
        );


        $datas = array(
            'liste_technologies' => $technologiesRepository->getList($page,$maxArticles),
            'pagination'  => $pagination) ;

        return $this->render('CSApplicationsBundle:Technologies:all.html.twig',$datas);
    }

    public function newAction(Request $request){


        $em = $this->getDoctrine()->getManager() ;
        $technologieRepository = $em->getRepository('CSApplicationsBundle:Technologie');
        $technologie = new Technologie() ;

        if($request->isMethod('POST')){

            $libelle = $request->get('libTechnologie');

            if(empty($libelle)){
                $request->getSession()->getFlashBag()->add('warning', 'Le libellé ne doit pas être nul !') ;
            }
            elseif ($technologieRepository->findByLibTechnologie($libelle)){
                $request->getSession()->getFlashBag()->add('warning', 'Cette technologie existe déjà.') ;
            }
            else{
                $technologie->setLibTechnologie($libelle) ;
                $em->persist($technologie);
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Une nouvelle technologie a été créée.') ;
            }
        }

        return $this->redirectToRoute('cs_technologies_all') ;

    }

    public function editAction(Request $request, $id){

        $em = $this->getDoctrine()->getManager() ;
        $technologieRepository = $em->getRepository('CSApplicationsBundle:Technologie');

        $technologie = $technologieRepository->find($id);

        if($request->isMethod('POST')){

            $libelle = $request->get('libTechnologie');

            if(empty($libelle)){
                $request->getSession()->getFlashBag()->add('warning', 'Le libellé ne doit pas être nul !') ;
            }
            elseif ($technologieRepository->findByLibTechnologie($libelle) && $libelle != $technologie->getLibTechnologie()){
                $request->getSession()->getFlashBag()->add('warning', 'Cette technologie existe déjà.') ;
            }
            else{
                $technologie->setLibTechnologie($libelle) ;
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'La technologie a été modifiée avec succès.') ;
            }
        }

        return $this->redirectToRoute('cs_technologies_all') ;
    }


    public function deleteAction(Request $request,$id){

        $em = $this->getDoctrine()->getManager() ;
        $technologieRepository = $em->getRepository('CSApplicationsBundle:Technologie');

        $technologie = $technologieRepository->find($id);

        if(!$technologie){
            $request->getSession()->getFlashBag()->add('warning', "Erreur fatale : la technologie n'exite pas!") ;
        }

        else{
            $em->remove($technologie) ;
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'La technologie a été supprimée avec succès.') ;
        }

        return $this->redirectToRoute('cs_technologies_all') ;

    }

}