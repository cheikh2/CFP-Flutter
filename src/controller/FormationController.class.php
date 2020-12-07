<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

use libs\system\Controller;
use src\model\FormationRepository;
class FormationController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

#========Recupération de toutes les formations===============
    public function index()
    {
        $formations = new FormationRepository();
        $resultat = $formations->getAllFormation();

        if($resultat != null)
        {
            foreach($resultat as $formation)
            {
                $formation = [
                    "Id" => $formation->getId(),
                    "Nom" => $formation->getNom(),
                ];

                $data['Formations'][] = $formation;

            }
            http_response_code(200);
            echo json_encode($data);
        }
        else
        {
            $data['Warning'] = "Désolé! aucune formation disponible";
            echo json_encode($data);
        }
    }

#==========Recupération d'une formation================
    public function getOneFormation()
    {
        extract($_POST);
        $formation = new FormationRepository();
        $resultat = $formation->getOneFormation($id);

        if($resultat != null)
        {
                $formation = [
                    "Id" => $resultat->getId(),
                    "Nom" => $resultat->getNom(),
                ];

                $data['Formation'][] = $formation;
            http_response_code(200);
            echo json_encode($data);
        }
        else
        {
            $data['Warning'] = "Désolé! aucune formation disponible";
            echo json_encode($data);
        }
    }

#===========Recupération programmes dune formation==========================

    public function programmes($id)
    {
        $formations = new FormationRepository();
        $resultat = $formations->getProgrammeByFormation($id);

        if($resultat != null)
        {
            foreach($resultat as $programme)
            {
                $programme = [
                    "Id" => $programme->getId(),
                    "Nom" => $programme->getNom(),
                ];

                $data['Programmes'][] = $programme;

            }
            http_response_code(200);
            echo json_encode($data);
        }
        else
        {
            $data['Warning'] = "Pas de programme disponible pour cette formation";
            echo json_encode($data);
        }
    }

}

?>