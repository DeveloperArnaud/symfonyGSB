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

    public function fichefraisAction(Request $request,$id) {

        $repository = $this->getDoctrine()->getManager()->getRepository('acmjBundle:Fraisforfait');
        $fraisf = $repository->findAll();

        $db = $this->get('gsb.pdo');
        $service = new GSBPdoService($db);
        

        $form2 =$this->createForm(LignefraisforfaitType::class);
        $form = $this->createForm(LignefraishorsforfaitType::class);
        $form->handleRequest($request);
        $form2->handleRequest($request);
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
            $fraishorsforfait->setIdVisiteur($id);
            $em = $this->getDoctrine()->getManager();
            $em->persist($fraishorsforfait);
            $em->flush();
            $lesVisiteurs = $service->getLesFraisForfaits();
            $lesInfosHorsforfaits = $service->getLesInfosHorsForfait($id);
            $message ="Le frais a bien été ajouté";
            
            return $this->render('@acmj/Default/FicheFrais.html.twig', array('form'=>$form->createView(),'fraisforfaits'=>$fraisf,'visiteurs'=>$lesVisiteurs,'infosHF'=>$lesInfosHorsforfaits,'message'=>$message,'formF'=>$form2->createView()));
        }

        elseif ($form2->isValid() && $form2->isSubmitted()) {
            $montantETP = $form2["ETP"]->getData();
            $montantKM = $form2["KM"]->getData();
            $montantNUI = $form2["NUI"]->getData();
            $montantREP = $form2["REP"]->getData();

            $lignefraisForfaitETP = new Lignefraisforfait();

            $lignefraisForfaitETP->setIdConcerner('ETP');
            $lignefraisForfaitETP->setDatemodification(new \DateTime('now'));
            $lignefraisForfaitETP->setIdEtre('CR');
            $lignefraisForfaitETP->setQuantite($montantETP);

            $lignefraisForfaitKM = new Lignefraisforfait();

            $lignefraisForfaitKM->setIdConcerner('KM');
            $lignefraisForfaitKM->setDatemodification(new \DateTime('now'));
            $lignefraisForfaitKM->setIdEtre('CR');
            $lignefraisForfaitKM->setQuantite($montantKM);

            $lignefraisForfaitNUI = new Lignefraisforfait();
            
            $lignefraisForfaitNUI->setIdConcerner('NUI');
            $lignefraisForfaitNUI->setDatemodification(new \DateTime('now'));
            $lignefraisForfaitNUI->setIdEtre('CR');
            $lignefraisForfaitNUI->setQuantite($montantNUI);

            
            $lignefraisForfaitREP = new Lignefraisforfait();
            
            $lignefraisForfaitREP->setIdConcerner('REP');
            $lignefraisForfaitREP->setDatemodification(new \DateTime('now'));
            $lignefraisForfaitREP->setIdEtre('CR');
            $lignefraisForfaitREP->setQuantite($montantREP);

            $fichefrais = new FicheFrais();
            $fichefrais->setIdEtre2('CR')
                        ->setIdDeclarer($id)
                        ->setMois('201902')
                        ->setNbjustificatifs(1)
                        ->setMontantvalide($fraishorsforfait->getMontant())
                        ->setDatemodif($fraishorsforfait->getDatemodif());
            $em = $this->getDoctrine()->getManager();
            $em->persist($lignefraisForfaitETP);
            $em->persist($lignefraisForfaitKM);
            $em->persist($lignefraisForfaitNUI);
            $em->persist($lignefraisForfaitREP);
            $em->persist($fichefrais);
            $em->flush();
            $lesVisiteurs = $service->getLesFraisForfaits();
            $lesInfosHorsforfaits = $service->getLesInfosHorsForfait($id);
            $message ="Les frais forfaits ont bien été ajoutés";
            return $this->render('@acmj/Default/FicheFrais.html.twig', array('form'=>$form->createView(),'fraisforfaits'=>$fraisf,'visiteurs'=>$lesVisiteurs,'infosHF'=>$lesInfosHorsforfaits,'formF'=>$form2->createView(),"messageFrais"=>$message));
            
        }

        $lesVisiteurs = $service->getLesFraisForfaits();
        $lesInfosHorsforfaits = $service->getLesInfosHorsForfait($id);
        return $this->render('@acmj/Default/FicheFrais.html.twig', array('form'=>$form->createView(),'fraisforfaits'=>$fraisf,'visiteurs'=>$lesVisiteurs,'infosHF'=>$lesInfosHorsforfaits,'formF'=>$form2->createView()));
    }

    public function consulterFichefraisAction(Request $request,$id)
    {
        $db = $this->get('gsb.pdo');
        $service = new GSBPdoService($db);
      
        
        $form = $this->createForm(FichefraisType::class);
        $form->handleRequest($request);
        if  ($form->isValid() && $form->isSubmitted()) {
         
            $infosFiche = $service->getLesInfos($id);
            $repository = $this->getDoctrine()->getManager()->getRepository('acmjBundle:Lignefraishorsforfait');
            $infosFraisHF = $repository->findAll();
            $repositoryFF = $this->getDoctrine()->getManager()->getRepository('acmjBundle:Fraisforfait');
            $infosFraisF = $repositoryFF->findAll();
            $repositoryFF1 = $this->getDoctrine()->getManager()->getRepository('acmjBundle:Lignefraisforfait');
            $infosFraisF1 = $repositoryFF1->findAll();

            if (empty($infosFiche)) {
                return $this->render('@acmj/Default/consulter_fiche_frais.html.twig',array('form'=>$form->createView(),'msg'=>"Pas de fiche frais pour ce mois-ci"));
            }
            
            
            
            return $this->render('@acmj/Default/consulter_fiche_frais.html.twig', array('infos'=> $infosFiche,'form'=>$form->createView(),'infosHF'=> $infosFraisHF,'infosFF'=>$infosFraisF,'infosFF1'=>$infosFraisF1));
            
        } 

        return $this->render('@acmj/Default/consulter_fiche_frais.html.twig',array('form'=>$form->createView()));
    
        
    }


    public function suppressionFraisHFAction($idFraisHF) {
        $repository = $this->getDoctrine()->getManager()->getRepository('acmjBundle:Fraisforfait');
        $fraisf = $repository->findAll();
        $form = $this->createForm(LignefraishorsforfaitType::class);
        $repository = $this->getDoctrine()->getManager()->getRepository('acmjBundle:Lignefraishorsforfait');
        $fraishorsforfait = $repository->find($idFraisHF);
        $em = $this->getDoctrine()->getManager();
        $em->remove($fraishorsforfait);
        $em->flush();
        $message ="Le frais a bien été supprimé";
        $db = $this->get('gsb.pdo');
        $service = new GSBPdoService($db);
        $lesVisiteurs = $service->getLesFraisForfaits();
        $lesInfosHorsforfaits = $service->getLesInfosHorsForfait($id);
        return $this->render('@acmj/Default/FicheFrais.html.twig', array('form'=>$form->createView(),'fraisforfaits'=>$fraisf,'visiteurs'=>$lesVisiteurs,'infosHF'=>$lesInfosHorsforfaits,"message"=>$message));

    }

    public function updateHFAction(Request $request,$idHF,$libelle,$montant) {
        $db = $this->get('gsb.pdo');
        $service = new GSBPdoService($db);
        $repository = $this->getDoctrine()->getManager()->getRepository('acmjBundle:Fraisforfait');
        $fraisf = $repository->findAll();
        $form = $this->createForm(LignefraishorsforfaitType::class);
        $lesVisiteurs = $service->getLesFraisForfaits();
        $lesInfosHorsforfaits = $service->getLesInfosHorsForfait($id);
        $repository = $this->getDoctrine()->getManager()->getRepository('acmjBundle:Lignefraishorsforfait');
        $libelle = $request->get("libelle");
        $montant = $request->get("montant");
        $update = $service->updateInfos($idHF,$libelle,$montant);
        $message ="Le frais a bien été modifié";
        return $this->render('@acmj/Default/FicheFrais.html.twig', array('form'=>$form->createView(),'fraisforfaits'=>$fraisf,'visiteurs'=>$lesVisiteurs,'infosHF'=>$lesInfosHorsforfaits,"messageUpdate"=>$message,"update"=>$update));
    } 
        


    
}

