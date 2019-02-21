<?php

namespace acmjBundle\Controller;

use acmjBundle\Entity\Fraisforfait;
use acmjBundle\Form\FraisforfaitType;
use acmjBundle\Form\LignefraisforfaitType;
use acmjBundle\Form\FichefraisType;
use acmjBundle\Service\GSBPdoService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use acmjBundle\Entity\Lignefraisforfait;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use acmjBundle\Entity\Fichefrais;
use acmjBundle\Form\LignefraishorsforfaitType;
use acmjBundle\Entity\Lignefraishorsforfait;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@acmj/Default/index.html.twig');
    }

    public function fichefraisAction(Request $request) {

        $repository = $this->getDoctrine()->getManager()->getRepository('acmjBundle:Fraisforfait');
        $fraisf = $repository->findAll();

        $db = $this->get('gsb.pdo');
        $service = new GSBPdoService($db);

        
        


        $form = $this->createForm(LignefraishorsforfaitType::class);
        $form->handleRequest($request);
        if ($form->isValid() && $form->isSubmitted()) {
            $date = $form["date"]->getData();
            $libelle = $form["libelle"]->getData();
            $montant = $form["montant"]->getData();

            $fraishorsforfait = new Lignefraishorsforfait();
            $fraishorsforfait->setDate($date);
            $fraishorsforfait->setIdEtre1('CR');
            $fraishorsforfait->setId1(1);
            $fraishorsforfait->setId2(1);
            $fraishorsforfait->setId3(3);
            $fraishorsforfait->setDatemodif(new \DateTime('now'));
            $fraishorsforfait->setLibelle($libelle);
            $fraishorsforfait->setMontant($montant);
            $em = $this->getDoctrine()->getManager();
            $em->persist($fraishorsforfait);
            $em->flush();
            $lesVisiteurs = $service->getLesFraisForfaits();
            $lesInfosHorsforfaits = $service->getLesInfosHorsForfait();
            
            return $this->render('@acmj/Default/FicheFrais.html.twig', array('form'=>$form->createView(),'fraisforfaits'=>$fraisf,'visiteurs'=>$lesVisiteurs,'infosHF'=>$lesInfosHorsforfaits));
        }

        $lesVisiteurs = $service->getLesFraisForfaits();
        $lesInfosHorsforfaits = $service->getLesInfosHorsForfait();
        return $this->render('@acmj/Default/FicheFrais.html.twig', array('form'=>$form->createView(),'fraisforfaits'=>$fraisf,'visiteurs'=>$lesVisiteurs,'infosHF'=>$lesInfosHorsforfaits));
    }

    public function consulterFichefraisAction(Request $request,$id)
    {
    
        $form = $this->createForm(FichefraisType::class);
        $form->handleRequest($request);
        if  ($form->isSubmitted()) {
            $mois=$form["mois"]->getData();
            $db = $this->get('gsb.pdo');
            $service = new GSBPdoService($db);
            $infosFiche = $service->getLesInfos($id);
            return $this->render('@acmj/Default/consulter_fiche_frais.html.twig', array('infos'=> $infosFiche,'form'=>$form->createView()));
            
        } 

        return $this->render('@acmj/Default/consulter_fiche_frais.html.twig',array('form'=>$form->createView()));
    
        
    }


    public function testAction(Request $request) {

    }
        


    
}

