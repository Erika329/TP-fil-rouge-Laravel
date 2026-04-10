<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Contract;
use App\Models\Project;
use App\Models\Ticket;
use App\Models\TimeEntry;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['email' => 'admin@ticketing.local'],
            [
                'name' => 'Admin ESIEA',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'phone' => '0600000001',
                'department' => 'Administration',
                'bio' => 'Administrateur principal de la plateforme.',
            ]
        );

        $collaborator = User::updateOrCreate(
            ['email' => 'erika@exemple.fr'],
            [
                'name' => 'Erika Kamdom',
                'password' => Hash::make('password'),
                'role' => 'collaborateur',
                'phone' => '0600000002',
                'department' => 'Developpement',
                'bio' => 'Developpeuse Laravel et JavaScript.',
            ]
        );

        $nova = Client::updateOrCreate(
            ['email' => 'contact@agencenova.fr'],
            [
                'name' => 'Agence Nova',
                'phone' => '+33 1 23 45 67 00',
                'company' => 'Agence Nova',
                'notes' => 'Client historique avec contrat annuel.',
            ]
        );

        $clientUser = User::updateOrCreate(
            ['email' => 'contact@nova.fr'],
            [
                'name' => 'Contact Nova',
                'password' => Hash::make('password'),
                'role' => 'client',
                'phone' => '0600000003',
                'department' => 'Client',
                'bio' => 'Representant du client Agence Nova.',
                'client_id' => $nova->id,
            ]
        );


        $orion = Client::updateOrCreate(
            ['email' => 'contact@clinique-orion.fr'],
            [
                'name' => 'Clinique Orion',
                'phone' => '+33 1 98 76 54 32',
                'company' => 'Clinique Orion',
                'notes' => 'Client secteur sante.',
            ]
        );

        $novaContract = Contract::updateOrCreate(
            ['name' => 'Contrat Nova 2026'],
            [
                'included_hours' => 50,
                'starts_at' => '2026-01-01',
                'ends_at' => '2026-12-31',
                'hourly_rate' => 80,
            ]
        );

        $orionContract = Contract::updateOrCreate(
            ['name' => 'Contrat Orion 2026'],
            [
                'included_hours' => 30,
                'starts_at' => '2026-01-01',
                'ends_at' => '2026-12-31',
                'hourly_rate' => 90,
            ]
        );

        $portalProject = Project::updateOrCreate(
            ['name' => 'Portail client'],
            [
                'client_id' => $nova->id,
                'contract_id' => $novaContract->id,
                'description' => 'Plateforme de suivi des demandes clients.',
                'status' => 'actif',
            ]
        );

        $hrProject = Project::updateOrCreate(
            ['name' => 'Intranet RH'],
            [
                'client_id' => $orion->id,
                'contract_id' => $orionContract->id,
                'description' => 'Outil interne pour la gestion RH.',
                'status' => 'actif',
            ]
        );

        $portalProject->collaborators()->syncWithoutDetaching([$admin->id, $collaborator->id]);
        $hrProject->collaborators()->syncWithoutDetaching([$collaborator->id]);

        $ticketOne = Ticket::updateOrCreate(
            ['title' => 'Bug formulaire contact'],
            [
                'project_id' => $portalProject->id,
                'created_by' => $collaborator->id,
                'description' => 'Le formulaire de contact ne transmet plus les messages.',
                'status' => 'en_cours',
                'priority' => 'haute',
                'type' => 'inclus',
                'estimated_hours' => 2.5,
                'is_billable' => false,
            ]
        );

        $ticketTwo = Ticket::updateOrCreate(
            ['title' => 'Ajout export PDF'],
            [
                'project_id' => $hrProject->id,
                'created_by' => $collaborator->id,
                'description' => 'Ajout d un export PDF sur la page de suivi.',
                'status' => 'a_valider',
                'priority' => 'moyenne',
                'type' => 'facturable',
                'estimated_hours' => 3,
                'is_billable' => true,
            ]
        );

        $ticketThree = Ticket::updateOrCreate(
            ['title' => 'Correction affichage mobile'],
            [
                'project_id' => $portalProject->id,
                'created_by' => $collaborator->id,
                'description' => 'Correction de la mise en page sur les ecrans mobiles.',
                'status' => 'nouveau',
                'priority' => 'basse',
                'type' => 'inclus',
                'estimated_hours' => 1.5,
                'is_billable' => false,
            ]
        );

        $ticketOne->assignees()->syncWithoutDetaching([$collaborator->id]);
        $ticketTwo->assignees()->syncWithoutDetaching([$collaborator->id, $clientUser->id]);
        $ticketThree->assignees()->syncWithoutDetaching([$collaborator->id]);

        TimeEntry::updateOrCreate(
            [
                'ticket_id' => $ticketOne->id,
                'work_date' => '2026-02-05',
                'comment' => 'Recherche du bug et correction du script PHP',
            ],
            [
                'user_id' => $collaborator->id,
                'duration_hours' => 2.5,
            ]
        );

        TimeEntry::updateOrCreate(
            [
                'ticket_id' => $ticketOne->id,
                'work_date' => '2026-02-04',
                'comment' => 'Test du formulaire',
            ],
            [
                'user_id' => $collaborator->id,
                'duration_hours' => 0.5,
            ]
        );

        TimeEntry::updateOrCreate(
            [
                'ticket_id' => $ticketTwo->id,
                'work_date' => '2026-02-04',
                'comment' => 'Preparation de l export PDF',
            ],
            [
                'user_id' => $collaborator->id,
                'duration_hours' => 3,
            ]
        );
    }
}
