<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

use libs\system\Controller;
use src\model\ProgrammeRepository;
class ProgrammeController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }


#==========Recupération des Programmes================
    public function index()
    {
        $programmes = new ProgrammeRepository();
        $resultat = $programmes->getAllProgramme();
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
            $data['Warning'] = "Désolé! aucune formation disponible";
            echo json_encode($data);
        }
    }

#==========Recupération d'un programme====================
    public function getOneProgramme()
    {
        extract($_POST);
        $programme = new ProgrammeRepository();
        $resultat = $programme->getOneProgramme($id);

        if($resultat != null)
        {
                $programme = [
                    "Id" => $resultat->getId(),
                    "Nom" => $resultat->getNom(),
                ];
                $data['Programme'][] = $programme;
            http_response_code(200);
            echo json_encode($data);
        }
        else
        {
            $data['Warning'] = "Désolé! aucun programme disponible";
            echo json_encode($data);
        }
    }
}
?>