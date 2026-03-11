<?php
// Erika KAMDOM FOTSO 3A FISE
// TP Fil Rouge / Application de gestion de Ticket
// Service de traitement du formulaire de création de ticket

class TicketService {
    public $titre;
    public $projet;
    public $description;
    public $priorite;
    public $type;
    public $estimation;
    public $assignes;
    public $statut;

    // Constructeur : récupère et sécurise les données du formulaire
    function __construct($data) {
        $this->titre       = htmlspecialchars($data["titre"] ?? "");
        $this->projet      = htmlspecialchars($data["projet"] ?? "");
        $this->description = htmlspecialchars($data["description"] ?? "");
        $this->priorite    = htmlspecialchars($data["priorite"] ?? "");
        $this->type        = htmlspecialchars($data["type"] ?? "");
        $this->estimation  = htmlspecialchars($data["estimation"] ?? "");
        $this->assignes    = htmlspecialchars($data["assignes"] ?? "");
        $this->statut      = htmlspecialchars($data["statut"] ?? "");
    }

    // Retourne un tableau structuré avec les données du ticket
    public function set_new_ticket() {
        return [
            "titre"       => $this->titre,
            "projet"      => $this->projet,
            "description" => $this->description,
            "priorite"    => $this->priorite,
            "type"        => $this->type,
            "estimation"  => $this->estimation,
            "assignes"    => $this->assignes,
            "statut"      => $this->statut,
        ];
    }
}