<?php

namespace acmjBundle\Controller;

use acmjBundle\Entity\Fraisforfait;
use acmjBundle\Form\FraisforfaitType;
use acmjBundle\Form\LignefraisforfaitType;
use acmjBundle\Service\GSBPdoService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use acmjBundle\Entity\Lignefraisforfait;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@acmj/Default/index.html.twig');
    }

    public function FicheFraisAction(Request $request, $id) {

        $repository = $this->getDoctrine()->getManager()->getRepository('acmjBundle:Lignefraishorsforfait');
        $lignefhf = $repository->findAll();
        $repository = $this->getDoctrine()->getManager()->getRepository('acmjBundle:Fraisforfait');
        $fraisf = $repository->findAll();

        $db = $this->get('gsb.pdo');
        $service = new GSBPdoService($db);

        $lesVisiteurs = $service->getLesVisiteurs();

        return $this->render('@acmj/Default/FicheFrais.html.twig', array('fraishorsforfaits'=>$lignefhf,'fraisforfaits'=>$fraisf,'visiteurs'=>$lesVisiteurs));
        }










}