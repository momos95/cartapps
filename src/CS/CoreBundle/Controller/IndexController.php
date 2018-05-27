<?php
/**
 * Created by PhpStorm.
 * User: dnid
 * Date: 13/06/17
 * Time: 14:41
 */

namespace CS\CoreBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{

    public function homeAction()
    {
        if($this->getUser()){
            return $this->redirectToRoute('cs_applications_all') ;
        }

        return $this->render('CSCoreBundle:Index:home.html.twig');
    }


}