<?php
/**
 * Created by PhpStorm.
 * User: dnid
 * Date: 10/07/17
 * Time: 16:04
 */

namespace CS\ServeursBundle\Controller;


use CS\ServeursBundle\Entity\Os;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class OsController extends Controller
{

    public function allAction($page)
    {
        $maxArticles = $this->container->getParameter('max_item_per_page') ;

        $em = $this->getDoctrine()->getManager() ;

        $osRepository = $em->getRepository('CSServeursBundle:Os');

        $articles_count = count($osRepository->findAll());

        $pagination = array(
            'page' => $page,
            'route' => 'cs_os_all',
            'pages_count' => ceil($articles_count / $maxArticles),
            'route_params' => array()
        );


        $datas = array(
            'liste_os' => $osRepository->getList($page,$maxArticles),
            'pagination'  => $pagination) ;

        return $this->render('CSServeursBundle:Os:all.html.twig',$datas);
    }

    public function newAction(Request $request){


        $em = $this->getDoctrine()->getManager() ;
        $osRepository = $em->getRepository('CSServeursBundle:Os');
        $os = new Os() ;

        if($request->isMethod('POST')){

            $libelle = $request->get('libOs');

            if(empty($libelle)){
                $request->getSession()->getFlashBag()->add('warning', 'Le libellé ne doit pas être nul !') ;
            }
            elseif ($osRepository->findByLibOs($libelle)){
                $request->getSession()->getFlashBag()->add('warning', 'Ce systéme  existe déjà.') ;
            }
            else{
                $os->setLibOs($libelle) ;
                $em->persist($os);
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Un nouveau SE a été créé.') ;
            }
        }

        return $this->redirectToRoute('cs_os_all') ;

    }

    public function editAction(Request $request, $id){

        $em = $this->getDoctrine()->getManager() ;
        $osRepository = $em->getRepository('CSServeursBundle:Os');

        $os = $osRepository->find($id);

        if($request->isMethod('POST')){

            $libelle = $request->get('libOs');

            if(empty($libelle)){
                $request->getSession()->getFlashBag()->add('warning', 'Le libellé ne doit pas être nul !') ;
            }
            elseif ($osRepository->findByLibOs($libelle) && $libelle != $os->getLibOs()){
                $request->getSession()->getFlashBag()->add('warning', 'Ce SE existe déjà.') ;
            }
            else{
                $os->setLibOs($libelle) ;
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Le SE a été modifié avec succès.') ;
            }
        }

        return $this->redirectToRoute('cs_os_all') ;
    }

    public function deleteAction(Request $request,$id){

        $em = $this->getDoctrine()->getManager() ;
        $osRepository = $em->getRepository('CSServeursBundle:Os');
        $os = $osRepository->find($id);

        if(!$os){
            $request->getSession()->getFlashBag()->add('warning', "Erreur fatale : le SE n'exite pas!") ;
        }

        else{
            $em->remove($os) ;
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'Le SE a été supprimé avec succès.') ;
        }

        return $this->redirectToRoute('cs_os_all') ;

    }

}