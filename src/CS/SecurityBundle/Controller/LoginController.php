<?php
/**
 * Created by PhpStorm.
 * User: dnid
 * Date: 19/05/17
 * Time: 08:20
 */

namespace CS\SecurityBundle\Controller;

use Symfony\Component\HttpFoundation\Request ;
use Symfony\Component\HttpFoundation\Response ;
use Symfony\Bundle\FrameworkBundle\Controller\Controller ;
use Symfony\Component\Security\Core\Security;

class LoginController extends Controller
{
    public function indexAction(Request $request){

        if($this->get('security.authorization_checker')->isGranted('IS_AUTHENTIFICATED_REMEMBERED')){
            return $this->redirectToRoute('cs_applications_all') ;
        }

        $authentificationUtils = $this->get('security.authentication_utils') ;

        $datas = array(
            'last_username'     => $authentificationUtils->getLastUsername() ,
            'error'             => $authentificationUtils->getLastAuthenticationError()
        ) ;

        $content = $this->get('templating')->render('CSSecurityBundle:Login:index.html.twig',$datas) ;

        return new Response($content) ;
    }

    public function forgetAction(){

        $datas = array(
            'error'             => false
        ) ;

        $content = $this->get('templating')->render('CSSecurityBundle:Login:forget.html.twig',$datas) ;

        return new Response($content) ;
    }

}