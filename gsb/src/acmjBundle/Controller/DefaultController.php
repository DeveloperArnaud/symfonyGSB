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
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use acmjBundle\Entity\Fichefrais;
use acmjBundle\Entity\Visiteur;
use acmjBundle\Form\LignefraishorsforfaitType;
use acmjBundle\Entity\Lignefraishorsforfait;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@acmj/Default/index.html.twig');
    }

    /**
     * @param Request $request
     * @param $id
     * @return Response
     * @throws \Exception
     */
    public function fichefraisAction(Request $request, $id)
    {

        $repository = $this->getDoctrine()->getManager()->getRepository('acmjBundle:Fraisforfait');
        $fraisf = $repository->findAll();

        $db = $this->get('gsb.pdo');
        $service = new GSBPdoService($db);

        $repository = $this->getDoctrine()->getManager()->getRepository('acmjBundle:Fichefrais');
        $ficheduMois = $repository->findByIdVisiteurAndMois($id, '201904');
        if (empty($ficheduMois)) {
            $fiche = new Fichefrais();
            $visiteur = $this->getDoctrine()->getManager()->getRepository('acmjBundle:Visiteur')->findOneBy(array('id' => $id));
            $etatFiche = $this->getDoctrine()->getManager()->getRepository('acmjBundle:Etat')->findOneBy(array('id' => "CR"));
            $fiche->setIdvisiteur($visiteur)
                ->setDatemodif(new \DateTime('now'))
                ->setIdetat($etatFiche)
                ->setMois('201904')
                ->setNbjustificatifs(0);
            $em = $this->getDoctrine()->getManager();
            $em->persist($fiche);
            $em->flush();
        }

        $form2 = $this->createForm(LignefraisforfaitType::class);
        $form = $this->createForm(LignefraishorsforfaitType::class);
        $form->handleRequest($request);
        $form2->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted()) {
            $date = $form["date"]->getData();
            $libelle = $form["libelle"]->getData();
            $montant = $form["montant"]->getData();

            $fraishorsforfait = new Lignefraishorsforfait();
            $fraishorsforfait->setDatemodif(new \DateTime('now'))
                ->setDate($date);
            $visiteur = $this->getDoctrine()->getManager()->getRepository('acmjBundle:Visiteur')->findOneBy(array('id' => $id));
            $fraishorsforfait->setIdvisiteur($visiteur);
            $repository = $this->getDoctrine()->getManager()->getRepository('acmjBundle:Fichefrais');
            $fiche = $repository->findOneBy(array('idvisiteur' => $visiteur->getId(), 'mois' => '201904'));

            $fraishorsforfait->setIdFichefrais($fiche);

            $fraishorsforfait->setLibelle($libelle);
            $fraishorsforfait->setMontant($montant);
            $em = $this->getDoctrine()->getManager();
            $em->persist($fraishorsforfait);
            $em->flush();


            $lesVisiteurs = $service->getLesFraisForfaits();
            $lesInfosHorsforfaits = $service->getLesInfosHorsForfait($id);

            //$montantHF = $service->countLigneHorsForfait($id,$maFiche->getId());
            $message = "Le frais a bien été ajouté";

            return $this->render('@acmj/Default/FicheFrais.html.twig', array('form' => $form->createView(), 'fraisforfaits' => $fraisf, 'visiteurs' => $lesVisiteurs, 'infosHF' => $lesInfosHorsforfaits, 'message' => $message, 'formF' => $form2->createView()));
        } elseif ($form2->isValid() && $form2->isSubmitted()) {
            $montantETP = $form2["ETP"]->getData();
            $montantKM = $form2["KM"]->getData();
            $montantNUI = $form2["NUI"]->getData();
            $montantREP = $form2["REP"]->getData();
            $visiteur = $this->getDoctrine()->getManager()->getRepository('acmjBundle:Visiteur')->findOneBy(array('id' => $id));
            $repository = $this->getDoctrine()->getManager()->getRepository('acmjBundle:Fichefrais');
            $fiche = $repository->findOneBy(array('idvisiteur' => $visiteur->getId(), 'mois' => '201904'));
            $lffETP = $this->getDoctrine()->getManager()->getRepository('acmjBundle:Lignefraisforfait')->findOneBy(array('idvisiteur' => $id, 'idFichefrais' => $fiche->getId(), 'id' => "ETP"));
            if (empty($lffETP)) {
                $lignefraisForfaitETP = new Lignefraisforfait();
                $visiteur = $this->getDoctrine()->getManager()->getRepository('acmjBundle:Visiteur')->findOneBy(array('id' => $id));
                $lignefraisForfaitETP->setIdvisiteur($visiteur);
                $lignefraisForfaitETP->setDatemodification(new \DateTime('now'));
                $fraisforfait = $this->getDoctrine()->getManager()->getRepository('acmjBundle:Fraisforfait')->findOneBy(array('id' => "ETP"));
                $lignefraisForfaitETP->setQuantite($montantETP)
                    ->setIdFraisforfait($fraisforfait);

                $em = $this->getDoctrine()->getManager();
                $em->persist($lignefraisForfaitETP);
                $em->flush();
            }

            $lffKM = $this->getDoctrine()->getManager()->getRepository('acmjBundle:Lignefraisforfait')->findOneBy(array('idvisiteur' => $id, 'idFichefrais' => $fiche->getId(), 'id' => "KM"));
            if (empty($lffKM)) {
                $lignefraisForfaitKM = new Lignefraisforfait();
                $lignefraisForfaitKM->setIdvisiteur($visiteur);
                $lignefraisForfaitKM->setDatemodification(new \DateTime('now'));
                $fraisforfait = $this->getDoctrine()->getManager()->getRepository('acmjBundle:Fraisforfait')->findOneBy(array('id' => "KM"));
                $lignefraisForfaitETP->setQuantite($montantKM)
                    ->setIdFraisforfait($fraisforfait)
                    ->setIdFichefrais($fiche);
                $em = $this->getDoctrine()->getManager();
                $em->persist($lignefraisForfaitKM);
                $em->flush();
            }

            $lffNUI = $this->getDoctrine()->getManager()->getRepository('acmjBundle:Lignefraisforfait')->findOneBy(array('idvisiteur' => $id, 'idFichefrais' => $fiche->getId(), 'id' => "KM"));

            if (empty($lffNUI)) {
                $lignefraisForfaitNUI = new Lignefraisforfait();
                $lignefraisForfaitNUI->setIdvisiteur($visiteur);
                $lignefraisForfaitNUI->setDatemodification(new \DateTime('now'));
                $fraisforfait = $this->getDoctrine()->getManager()->getRepository('acmjBundle:Fraisforfait')->findOneBy(array('id' => "NUI"));
                $lignefraisForfaitNUI->setQuantite($montantNUI)
                    ->setIdFraisforfait($fraisforfait)
                    ->setIdFichefrais($fiche);
                $em = $this->getDoctrine()->getManager();
                $em->persist($lignefraisForfaitNUI);
                $em->flush();
            }
            $lffREP = $this->getDoctrine()->getManager()->getRepository('acmjBundle:Lignefraisforfait')->findOneBy(array('idvisiteur' => $id, 'idFichefrais' => $fiche->getId(), 'id' => "REP"));

            if (empty($lffREP)) {
                $lignefraisForfaitREP = new Lignefraisforfait();
                $lignefraisForfaitREP->setIdvisiteur($visiteur);
                $lignefraisForfaitREP->setDatemodification(new \DateTime('now'));
                $fraisforfait = $this->getDoctrine()->getManager()->getRepository('acmjBundle:Fraisforfait')->findOneBy(array('id' => "REP"));
                $lignefraisForfaitREP->setQuantite($montantREP)
                    ->setIdFraisforfait($fraisforfait)
                    ->setIdFichefrais($fiche);
                $em = $this->getDoctrine()->getManager();
                $em->persist($lignefraisForfaitREP);
                $em->flush();
            }

            $lesVisiteurs = $service->getLesFraisForfaits();

            $lesInfosHorsforfaits = $service->getLesInfosHorsForfait($id);
            $message = "Les frais forfaits ont bien été ajoutés";
            return $this->render('@acmj/Default/FicheFrais.html.twig', array('form' => $form->createView(), 'fraisforfaits' => $fraisf, 'visiteurs' => $lesVisiteurs, 'infosHF' => $lesInfosHorsforfaits, 'formF' => $form2->createView(), "messageFrais" => $message));
        }
        $lesVisiteurs = $service->getLesFraisForfaits();
        $lesInfosHorsforfaits = $service->getLesInfosHorsForfait($id);
        $repository = $this->getDoctrine()->getManager()->getRepository('acmjBundle:Fichefrais');
        $fiche = $repository->findOneBy(array('idvisiteur' => $id, 'mois' => '201904'));
        $lesQuantitesFraisForfaits = $this->getDoctrine()->getManager()->getRepository('acmjBundle:Lignefraisforfait')->findBy(array('idvisiteur' => $id, 'idFichefrais' => $fiche->getId()));
        if (empty($lesQuantitesFraisForfaits)) {
            $form2->get('ETP')->setData(0);
            $form2->get('KM')->setData(0);
            $form2->get('NUI')->setData(0);
            $form2->get('REP')->setData(0);
            return $this->render('@acmj/Default/FicheFrais.html.twig', array('form' => $form->createView(), 'fraisforfaits' => $fraisf, 'visiteurs' => $lesVisiteurs, 'infosHF' => $lesInfosHorsforfaits, 'formF' => $form2->createView()));


        } else {
            $quantiteFraisForfaitETP = $this->getDoctrine()->getManager()->getRepository('acmjBundle:Lignefraisforfait')->findOneBy(array('idvisiteur' => $id, 'idFraisforfait' => "ETP", 'idFichefrais' => $fiche->getId()));
            $form2->get('ETP')->setData($quantiteFraisForfaitETP->getQuantite());
            $quantiteFraisForfaitKM = $this->getDoctrine()->getManager()->getRepository('acmjBundle:Lignefraisforfait')->findOneBy(array('idvisiteur' => $id, 'idFraisforfait' => "KM", 'idFichefrais' => $fiche->getId()));
            $form2->get('KM')->setData($quantiteFraisForfaitKM->getQuantite());
            $quantiteFraisForfaitNUI = $this->getDoctrine()->getManager()->getRepository('acmjBundle:Lignefraisforfait')->findOneBy(array('idvisiteur' => $id, 'idFraisforfait' => "NUI", 'idFichefrais' => $fiche->getId()));
            $form2->get('NUI')->setData($quantiteFraisForfaitNUI->getQuantite());
            $quantiteFraisForfaitREP = $this->getDoctrine()->getManager()->getRepository('acmjBundle:Lignefraisforfait')->findOneBy(array('idvisiteur' => $id, 'idFraisforfait' => "REP", 'idFichefrais' => $fiche->getId()));
            $form2->get('REP')->setData($quantiteFraisForfaitREP->getQuantite());

            if (!empty($lesQuantitesFraisForfaits) && $form2->isSubmitted() && $form2->isValid()) {
                $quantiteFraisForfaitETP = $this->getDoctrine()->getManager()->getRepository('acmjBundle:Lignefraisforfait')->findOneBy(array('idvisiteur' => $id, 'idFraisforfait' => "ETP", 'idFichefrais' => $fiche->getId()));
                $service->updateInfosForfait($quantiteFraisForfaitETP->getId(), $form2->get('ETP')->getData());
                $quantiteFraisForfaitKM = $this->getDoctrine()->getManager()->getRepository('acmjBundle:Lignefraisforfait')->findOneBy(array('idvisiteur' => $id, 'idFraisforfait' => "KM", 'idFichefrais' => $fiche->getId()));
                $service->updateInfosForfait($quantiteFraisForfaitKM->getId(), $form2->get('KM')->getData());
                $quantiteFraisForfaitNUI = $this->getDoctrine()->getManager()->getRepository('acmjBundle:Lignefraisforfait')->findOneBy(array('idvisiteur' => $id, 'idFraisforfait' => "NUI", 'idFichefrais' => $fiche->getId()));
                $service->updateInfosForfait($quantiteFraisForfaitNUI->getId(), $form2->get('NUI')->getData());
                $quantiteFraisForfaitREP = $this->getDoctrine()->getManager()->getRepository('acmjBundle:Lignefraisforfait')->findOneBy(array('idvisiteur' => $id, 'idFraisforfait' => "REP", 'idFichefrais' => $fiche->getId()));
                $service->updateInfosForfait($quantiteFraisForfaitREP->getId(), $form2->get('REP')->getData());
                $message = "Le(s) frais forfait(s) ont étés modifiées";
                return $this->render('@acmj/Default/FicheFrais.html.twig', array('form' => $form->createView(), 'fraisforfaits' => $fraisf, 'visiteurs' => $lesVisiteurs, 'infosHF' => $lesInfosHorsforfaits, 'formF' => $form2->createView()));

            }

            return $this->render('@acmj/Default/FicheFrais.html.twig', array('form' => $form->createView(), 'fraisforfaits' => $fraisf, 'visiteurs' => $lesVisiteurs, 'infosHF' => $lesInfosHorsforfaits, 'formF' => $form2->createView()));
        }

    }



    public function consulterFichefraisAction(Request $request,$id)
    {

        $form = $this->createForm(FichefraisType::class);
        $form->handleRequest($request);
        if  ($form->isValid() && $form->isSubmitted()) {
            $moisFiche = $form["mois"]->getData();
            $infosFicheSelected = $this->getDoctrine()->getManager()->getRepository('acmjBundle:Fichefrais')->findOneBy(array('mois'=>$moisFiche));
            if(!empty($infosFicheSelected)) {
                $infosFraisHF = $this->getDoctrine()->getManager()->getRepository('acmjBundle:Lignefraishorsforfait')->findBy(array('idvisiteur'=>$id,'idFichefrais' => $infosFicheSelected->getId()));

                $infosFiche= $this->getDoctrine()->getManager()->getRepository('acmjBundle:Fichefrais')->findOneBy(array('mois'=>$moisFiche,'idvisiteur'=>$id));
                $infosFraisF = $this->getDoctrine()->getManager()->getRepository('acmjBundle:Lignefraisforfait')->findBy(array('idvisiteur'=>$id,'idFichefrais' => $infosFicheSelected->getId()));
                $size = count($infosFraisHF);
                return $this->render('@acmj/Default/consulter_fiche_frais.html.twig', array('infos'=> $infosFiche,'form'=>$form->createView(),'infosHF'=> $infosFraisHF,'infosFF'=>$infosFraisF,'size'=>$size));
            } else {
                return $this->render('@acmj/Default/consulter_fiche_frais.html.twig', array('form' => $form->createView(), 'msg' => "Pas de fiche frais pour ce mois-ci"));
            }
        } 

        return $this->render('@acmj/Default/consulter_fiche_frais.html.twig',array('form'=>$form->createView()));
    
        
    }


    public function suppressionFraisHFAction($idFraisHF,$idVisiteur) {
        $repository = $this->getDoctrine()->getManager()->getRepository('acmjBundle:Fraisforfait');
        $fraisf = $repository->findAll();
        $form = $this->createForm(LignefraishorsforfaitType::class);
        $form2 =$this->createForm(LignefraisforfaitType::class);
        $repository = $this->getDoctrine()->getManager()->getRepository('acmjBundle:Lignefraishorsforfait');
        $fraishorsforfait = $repository->find($idFraisHF);
        $em = $this->getDoctrine()->getManager();
        $em->remove($fraishorsforfait);
        $em->flush();
        $message ="Le frais a bien été supprimé";
        $db = $this->get('gsb.pdo');
        $service = new GSBPdoService($db);
        $lesVisiteurs = $service->getLesFraisForfaits();
        $dateF = '201904';
        $lesInfosHorsforfaits = $service->getLesInfosHorsForfait($idVisiteur,$dateF);
        return $this->render('@acmj/Default/FicheFrais.html.twig', array('form'=>$form->createView(),'fraisforfaits'=>$fraisf,'visiteurs'=>$lesVisiteurs,'infosHF'=>$lesInfosHorsforfaits,"message"=>$message,'formF'=>$form2->createView()));

    }

    public function updateHFAction(Request $request,$idHF,$id) {
        $db = $this->get('gsb.pdo');
        $service = new GSBPdoService($db);
        $repository = $this->getDoctrine()->getManager()->getRepository('acmjBundle:Fraisforfait');
        $fraisf = $repository->findAll();
        $form = $this->createForm(LignefraishorsforfaitType::class);
        $lesVisiteurs = $service->getLesFraisForfaits();
        $dateF = '201904';
        $lesInfosHorsforfaits = $service->getLesInfosHorsForfait($id,$dateF);
        $repository = $this->getDoctrine()->getManager()->getRepository('acmjBundle:Lignefraishorsforfait');
        $libelle = $request->get("libelle");
        $montant = $request->get("montant");
        $update = $service->updateInfos($idHF,$libelle,$montant);
        $form2 =$this->createForm(LignefraisforfaitType::class);
        $message ="Le frais a bien été modifié";
        return $this->render('@acmj/Default/FicheFrais.html.twig', array('form'=>$form->createView(),'fraisforfaits'=>$fraisf,'visiteurs'=>$lesVisiteurs,'infosHF'=>$lesInfosHorsforfaits,"messageUpdate"=>$message,"update"=>$update,'formF'=>$form2->createView()));
    } 

    public function updateForfaitAction(Request $request,$idForfait,$idVisiteur) {
        $db = $this->get('gsb.pdo');
        $service = new GSBPdoService($db);
        $repository = $this->getDoctrine()->getManager()->getRepository('acmjBundle:Fraisforfait');
        $fraisf = $repository->findAll();
        $form = $this->createForm(LignefraishorsforfaitType::class);
        $lesVisiteurs = $service->getLesFraisForfaits();
        $dateF = '201904';
        $lesInfosHorsforfaits = $service->getLesInfosHorsForfait($idVisiteur,$dateF);
        $repository = $this->getDoctrine()->getManager()->getRepository('acmjBundle:Lignefraishorsforfait');
        $quantite = $request->get("quantite");
        $update = $service->updateInfosForfait($idForfait,$quantite);
        $form2 =$this->createForm(LignefraisforfaitType::class);
        $message ="Le frais forfait a bien été modifié";
        return $this->render('@acmj/Default/FicheFrais.html.twig', array('form'=>$form->createView(),'fraisforfaits'=>$fraisf,'visiteurs'=>$lesVisiteurs,'infosHF'=>$lesInfosHorsforfaits,"messageUpdate"=>$message,"update"=>$update,'formF'=>$form2->createView()));
    } 



    
}

