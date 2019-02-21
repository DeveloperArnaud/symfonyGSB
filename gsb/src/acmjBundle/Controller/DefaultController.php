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

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@acmj/Default/index.html.twig');
    }

    public function fichefraisAction(Request $request, $id) {

        $repository = $this->getDoctrine()->getManager()->getRepository('acmjBundle:Lignefraishorsforfait');
        $lignefhf = $repository->findAll();
        $repository = $this->getDoctrine()->getManager()->getRepository('acmjBundle:Fraisforfait');
        $fraisf = $repository->findAll();

        $db = $this->get('gsb.pdo');
        $service = new GSBPdoService($db);

        $lesVisiteurs = $service->getLesFraisForfaits();

        $montant = $request->request->get('montant');
        $idFraisForfait = $request->request->get('idFraisForfait');
    
        
        if (!empty($montant)) {
            $lignefraisForfait = new Lignefraisforfait();
            $lignefraisForfait->setIdConcerner($idFraisForfait);
            $lignefraisForfait->setIdVisiteur($id);
            $lignefraisForfait->setQuantite($montant);
            $lignefraisForfait->setDatemodification(new \DateTime('now'));
            return $this->render('@acmj/Default/ajoutfraisforfait.html.twig', array('fraishorsforfaits'=>$lignefhf,'fraisforfaits'=>$fraisf,'montants'=>$montant));

        } else {
        

        return $this->render('@acmj/Default/FicheFrais.html.twig', array('fraishorsforfaits'=>$lignefhf,'fraisforfaits'=>$fraisf,'visiteurs'=>$lesVisiteurs));
        }
    }

    public function consulterFichefraisAction()
    {
        $fichefrais = new Fichefrais();
    
        $form = $this->createForm(FichefraisType::class);
        return $this->render('@acmj/Default/consulter_fiche_frais.html.twig', array('form'=> $form->createView()));
    }
        


    
}

