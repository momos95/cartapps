<?php

namespace CS\UtilisateursBundle\Controller;

use CS\UtilisateursBundle\Entity\Role;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RolesController extends Controller
{

    public function allAction($page)
    {
        $maxArticles = $this->container->getParameter('max_item_per_page') ;

        $em = $this->getDoctrine()->getManager() ;

        $rolesRepository = $em->getRepository('CSUtilisateursBundle:Role');

        $articles_count = count($rolesRepository->findAll());

        $pagination = array(
            'page' => $page,
            'route' => 'cs_roles_all',
            'pages_count' => ceil($articles_count / $maxArticles),
            'route_params' => array()
        );


        $datas = array(
            'liste_roles' => $rolesRepository->getList($page,$maxArticles),
            'pagination'  => $pagination) ;

        return $this->render('CSUtilisateursBundle:Role:all.html.twig',$datas);
    }

    public function newAction(Request $request){


        $em = $this->getDoctrine()->getManager() ;
        $rolesRepository = $em->getRepository('CSUtilisateursBundle:Role');
        $role = new Role() ;

        if($request->isMethod('POST')){

            $libelle = $request->get('libRole');

            if(empty($libelle)){
                $request->getSession()->getFlashBag()->add('warning', 'Le libellé ne doit pas être nul !') ;
            }
            elseif ($rolesRepository->findByLibRole($libelle)){
                $request->getSession()->getFlashBag()->add('warning', 'Ce rôle existe déjà.') ;
            }
            else{
                $role->setLibRole($libelle) ;
                $em->persist($role);
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Un nouveau rôle a été créé.') ;
            }
        }

        return $this->redirectToRoute('cs_roles_all') ;

    }

    public function editAction(Request $request, $id){

        $em = $this->getDoctrine()->getManager() ;
        $rolesRepository = $em->getRepository('CSUtilisateursBundle:Role');

        $role = $rolesRepository->find($id);

        if($request->isMethod('POST')){

            $libelle = $request->get('libRole');

            if(empty($libelle)){
                $request->getSession()->getFlashBag()->add('warning', 'Le libellé ne doit pas être nul !') ;
            }
            elseif ($rolesRepository->findByLibRole($libelle) && $libelle != $role->getLibRole()){
                $request->getSession()->getFlashBag()->add('warning', 'Ce rôle existe déjà.') ;
            }
            else{
                $role->setLibRole($libelle) ;
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Le rôle a été modifié avec succès.') ;
            }
        }

        return $this->redirectToRoute('cs_roles_all') ;
    }

    public function deleteAction(Request $request,$id){

        $em = $this->getDoctrine()->getManager() ;
        $rolesRepository = $em->getRepository('CSUtilisateursBundle:Role');
        $role = $rolesRepository->find($id);

        if(!$role){
            $request->getSession()->getFlashBag()->add('warning', "Erreur fatale : le rôle n'exite pas!") ;
        }

        else{
            $em->remove($role) ;
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'Le rôle a été supprimé avec succès.') ;
        }

        return $this->redirectToRoute('cs_roles_all') ;

    }
    
}
