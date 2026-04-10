//Erika KAMDOM FOTSO
//TP FIL ROUGE
//SCRIPT JAVASCRIPT

//------------------// 
//FORMULAIRES 

//Vérification des champs du formulaire de connexion
function check_login(){
	//On vérifie les champs du formulaire
	const identifiant = document.querySelector("#identifiant");
	const mot_de_passe = document.querySelector('#mot_de_passe');

	//On récupère la valeur des input
	console.log("identifiant :", identifiant.value);
	//à retirer plus tard pour la sécurité
	console.log("mot_de_passe :", mot_de_passe.value);

	let nb_errors = 0;
	// Vérification identifiant
	const identifiant_error = document.querySelector('#identifiant_error');
	if (identifiant.value === "") {
		identifiant_error.classList.remove('hidden');
		nb_errors++;
	} else {
		identifiant_error.classList.add('hidden');
	}

	// Vérification mot de passe
	const mdp_error = document.querySelector('#mdp_error');
	if (mot_de_passe.value === "") {
		mdp_error.classList.remove('hidden');
		nb_errors++;
	} else {
		mdp_error.classList.add('hidden');
	}

	return nb_errors;
}	
//Validation du formulaire de connexion 
const f = document.querySelector('#submitform');

if (f) {
    f.addEventListener("submit", function(event) {

        const connexion_valide = document.querySelector('#connexion_valide');
        const nb_errors = check_login();

        if (nb_errors > 0) {
            event.preventDefault(); // on bloque l'envoi du formulaire seulement s'il y a des erreurs
            connexion_valide.classList.add('hidden');
        } else {
            connexion_valide.classList.remove('hidden');
        }

    });
}

//------------//

// Validation du formulaire mot de passe oublié

const forgotForm = document.querySelector('#forgotform');
if(forgotForm) {
    forgotForm.addEventListener('submit', function(event) {
        console.log('Formulaire mot de passe oublié soumis');
        const email = document.querySelector('#email');
        const email_error = document.querySelector('#email_error');
        const mail_valide = document.querySelector('#mail_valide');
        let nb_errors = 0;

        // Vérification email
        if(!email.value) {
            email_error.classList.remove('hidden');
            nb_errors++;
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) {
            email_error.textContent = "Veuillez saisir un email valide.";
            email_error.classList.remove('hidden');
            nb_errors++;
        } else {
            email_error.textContent = "L'email est obligatoire.";
            email_error.classList.add('hidden');
        }

        if (nb_errors > 0) {
            event.preventDefault(); // bloque si erreurs
            mail_valide.classList.add('hidden');
        } else {
            mail_valide.classList.remove('hidden');
            console.log('Mail envoyé');
        }
    });
}

//------------//

// Validation du formulaire de création de compte
const createForm = document.querySelector('#createform');
if(createForm) {
	createForm.addEventListener('submit', function(event) {
		
		let nb_errors = 0;
		const prenom = document.querySelector('#prenom');
		const nom = document.querySelector('#nom');
		const email = document.querySelector('#email');
		const role = document.querySelector('#role');
		const mot_de_passe = document.querySelector('#mot_de_passe');
		const prenom_error = document.querySelector('#prenom_error');
		const nom_error = document.querySelector('#nom_error');
		const email_error = document.querySelector('#email_error');
		const role_error = document.querySelector('#role_error');
		const mdp_error = document.querySelector('#mdp_error');
		const creation_valide = document.querySelector('#creation_valide');

		// Affichage des valeurs dans la console
		console.log('prenom :', prenom.value);
		console.log('nom :', nom.value);
		console.log('email :', email.value);
		console.log('role :', role.value);
					
		// Vérification prénom
		if(!prenom.value) {
			prenom_error.classList.remove('hidden');
			nb_errors++;
		} else {
			prenom_error.classList.add('hidden');
		}
		// Vérification nom
		if(!nom.value) {
			nom_error.classList.remove('hidden');
			nb_errors++;
		} else {
			nom_error.classList.add('hidden');
		}
		// Vérification email
		if(!email.value) {
			email_error.classList.remove('hidden');
			nb_errors++;
		}else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) {
			email_error.textContent = "Veuillez saisir un email valide.";
			email_error.classList.remove('hidden');
			nb_errors++;
		} else {
			email_error.textContent = "L'email est obligatoire."; // reset le message
			email_error.classList.add('hidden');
		}
		// Vérification rôle
		if(!role.value) {
			role_error.classList.remove('hidden');
			nb_errors++;
		} else {
			role_error.classList.add('hidden');
		}
		// Vérification mot de passe
		if(!mot_de_passe.value) {
			mdp_error.classList.remove('hidden');
			nb_errors++;
		} else {
			mdp_error.classList.add('hidden');
		}

		// Affichage du nombre d'erreurs
		console.log('nb_errors :', nb_errors);

		if (nb_errors > 0) {
			event.preventDefault(); // bloque si erreurs
			creation_valide.classList.add('hidden');
		} else {
			creation_valide.classList.remove('hidden');
			console.log('Compte créé');
		}
	});

}

//----------------------//


// Validation formulaire création utilisateur
const userForm = document.querySelector('#user-form'); // id du form
if(userForm) {

    const nom = document.querySelector('#nom');
    const prenom = document.querySelector('#prenom');
    const email = document.querySelector('#mail');
    const role = document.querySelector('#role');

    const nomError = document.querySelector('#nom_error');
    const prenomError = document.querySelector('#prenom_error');
    const emailError = document.querySelector('#email_error');
    const roleError = document.querySelector('#role_error');

    // Création de la notification si elle n'existe pas encore
    let notifUser = document.querySelector('.notif');
    if(!notifUser) {
        notifUser = document.createElement('div');
        notifUser.classList.add('notif');
        document.body.appendChild(notifUser);
    }

    userForm.addEventListener('submit', function(event){
        let errors = 0;

        if(!nom.value.trim()){ nomError.classList.remove('hidden'); errors++; } 
        else { nomError.classList.add('hidden'); }

        if(!prenom.value.trim()){ prenomError.classList.remove('hidden'); errors++; } 
        else { prenomError.classList.add('hidden'); }

        if(!email.value.trim()){ emailError.classList.remove('hidden'); errors++; } 
        else { emailError.classList.add('hidden'); }

        if(!role.value){ roleError.classList.remove('hidden'); errors++; } 
        else { roleError.classList.add('hidden'); }

        //Ajout du log du nombre d'erreurs 
        console.log('Nbr erreurs :', errors);

        if (errors > 0) {
        	event.preventDefault(); // bloque → PHP ne reçoit rien
        	notifUser.style.display = 'none';
    	} 
	});
}

// ---------------------- //
// FORMULAIRE DE CRÉATION DE TICKET

const ticketForm = document.querySelector('.ticket-form');
const btnEnregistrer = document.querySelector('#btn-enregistrer');

// Création d'une notification glissante si elle n'existe pas
let notifTicket = document.querySelector('.notif-ticket');
if(!notifTicket) {
    notifTicket = document.createElement('div');
    notifTicket.classList.add('notif', 'notif-ticket');
    document.body.appendChild(notifTicket);
}

if(btnEnregistrer && ticketForm) {
    ticketForm.addEventListener('submit', function(event) {
        let nb_errors = 0;

        // Récupération des champs
        const titre = document.querySelector('#titre');
        const projet = document.querySelector('#projet');
        const description = document.querySelector('#description');
        const priorite = document.querySelector('#priorite');
        const type = document.querySelector('#type');
        const estimation = document.querySelector('#estimation');
        const assignes = document.querySelector('#assignes');
        const statut = document.querySelector('#statut');

        // Récupération des div d'erreur
        const titre_error = document.querySelector('#titre_error');
        const projet_error = document.querySelector('#projet_error');
        const description_error = document.querySelector('#description_error');
        const priorite_error = document.querySelector('#priorite_error');
        const type_error = document.querySelector('#type_error');
        const estimation_error = document.querySelector('#estimation_error');
        const assignes_error = document.querySelector('#assignes_error');
        const statut_error = document.querySelector('#statut_error');

        // Vérification des champs
        if(!titre.value.trim()){ titre_error.classList.remove('hidden'); nb_errors++; } 
        else { titre_error.classList.add('hidden'); }

        if(!projet.value.trim()){ projet_error.classList.remove('hidden'); nb_errors++; } 
        else { projet_error.classList.add('hidden'); }

        if(!description.value.trim()){ description_error.classList.remove('hidden'); nb_errors++; } 
        else { description_error.classList.add('hidden'); }

        if(!priorite.value.trim()){ priorite_error.classList.remove('hidden'); nb_errors++; } 
        else { priorite_error.classList.add('hidden'); }

        if(!type.value.trim()){ type_error.classList.remove('hidden'); nb_errors++; } 
        else { type_error.classList.add('hidden'); }

        if(!estimation.value.trim()){ estimation_error.classList.remove('hidden'); nb_errors++; } 
        else { estimation_error.classList.add('hidden'); }

        if(!assignes.value.trim()){ assignes_error.classList.remove('hidden'); nb_errors++; } 
        else { assignes_error.classList.add('hidden'); }

        if(!statut.value.trim()){ statut_error.classList.remove('hidden'); nb_errors++; } 
        else { statut_error.classList.add('hidden'); }

        console.log('Nombre d\'erreurs :', nb_errors);

        if (nb_errors > 0) {
            event.preventDefault(); // bloque si erreurs, PHP ne reçoit rien
        } else {
            // pas de preventDefault → PHP reçoit $_POST et affiche le message
            notifTicket.textContent = `Le ticket "${titre.value}" a été créé avec succès.`;
            notifTicket.style.display = 'block';
			setTimeout(() => {
                ticketForm.submit();
            }, 2000);
        }
    });
}





//--------------------------------------------//

//FILTRE DES TICKETS 


function filtrerTable(config) {

	const recherche = config.recherche ? config.recherche.value.toLowerCase() : "";
	const lignes = config.tbody ? config.tbody.querySelectorAll("tr") : [];

	lignes.forEach(function(tr) {

		const cellules = tr.querySelectorAll("td");
		let visible = true;

		// Recherche le texte dans certaines colonnes
		if (recherche && config.searchColumns) {

			let match = false;

			config.searchColumns.forEach(function(index) {
				if (cellules[index] &&
					cellules[index].textContent.toLowerCase().includes(recherche)) {
					match = true;
				}
			});

			if (!match) visible = false;
		}

	
if (config.selectFilters) {
    config.selectFilters.forEach(function(filtre) {
        const valeurFiltre = filtre.element ? filtre.element.value.trim().toLowerCase() : "tous";
        const texteCellule = cellules[filtre.column].textContent.trim().toLowerCase();

        // On compare en utilisant includes pour matcher partiellement et ignorer casse
        if (valeurFiltre !== "tous" && !texteCellule.includes(valeurFiltre)) {
            visible = false;
        }
    });
}



		tr.style.display = visible ? "" : "none";
	});
}


// CONFIGURATION CLIENT
const clientBody = document.querySelector("#tickets-client-table tbody");

if (clientBody) {

	const clientConfig = {
		tbody: clientBody,
		recherche: document.querySelector("body.role-client #recherche-ticket"),

		searchColumns: [0, 1],

		selectFilters: [
			{
				element: document.querySelector("body.role-client #filtre-statut"),
				column: 3
			}
		]
	};

	const btnClient = document.querySelector("body.role-client button[type='button']");

	if (btnClient) {
		btnClient.addEventListener("click", function() {
			filtrerTable(clientConfig);
		});
	}

	if (clientConfig.recherche) {
		clientConfig.recherche.addEventListener("input", function() {
			filtrerTable(clientConfig);
		});
	}
}

// CONFIGURATION COLLABORATEUR
const collabBody = document.querySelector("#tickets-table tbody");

if (collabBody) {

	const collabConfig = {
		tbody: collabBody,
		recherche: document.querySelector("body:not(.role-client) #recherche-ticket"),

		searchColumns: [0, 1],

		selectFilters: [
			{
				element: document.querySelector("#filtre-statut"),
				column: 3
			},
			{
				element: document.querySelector("#filtre-projet"),
				column: 2
			},
			{
				element: document.querySelector("#filtre-type"),
				column: 5
			}
		]
	};

	const btnCollab = document.querySelector("#btn-filtrer");

	if (btnCollab) {
		btnCollab.addEventListener("click", function() {
			filtrerTable(collabConfig);
		});
	}

	if (collabConfig.recherche) {
		collabConfig.recherche.addEventListener("input", function() {
			filtrerTable(collabConfig);
		});
	}
}

//FILTRE DES PROJETS

const projectsBody = document.querySelector("#projects-table tbody");
const btnFiltrer = document.querySelector("#btn-filtrer");
const rechercheProjet = document.querySelector("#recherche-projet");

if (projectsBody && btnFiltrer) {
    const projectsConfig = {
        tbody: projectsBody,
        recherche: rechercheProjet,
        searchColumns: [0], // on cherche dans la colonne projet
        selectFilters: [
            { element: document.querySelector("#filtre-statut"), column: 1 }, // Client
            { element: document.querySelector("#filtre-projet"), column: 4 }  // Statut
        ]
    };

    btnFiltrer.addEventListener("click", function() {
        filtrerTable(projectsConfig);
    });

    if (projectsConfig.recherche) {
        projectsConfig.recherche.addEventListener("input", function() {
            filtrerTable(projectsConfig);
        });
    }
}


// Validation du formulaire de création de projet
const projectForm = document.querySelector('#projectform');
if(projectForm) {
	projectForm.addEventListener('submit', function(event) {

		let nb_errors = 0;
		const nomProjet = document.querySelector('#nom-projet');
		const client = document.querySelector('#client');
		const contrat = document.querySelector('#contrat');
		const taux = document.querySelector('#taux');
		const periode = document.querySelector('#periode');
		const collaborateurs = document.querySelector('#collaborateurs');
		const descriptionProjet = document.querySelector('#description-projet');
		const nomProjet_error = document.querySelector('#nom_projet_error');
		const client_error = document.querySelector('#client_error');
		const contrat_error = document.querySelector('#contrat_error');
		const taux_error = document.querySelector('#taux_error');
		const periode_error = document.querySelector('#periode_error');
		const collaborateurs_error = document.querySelector('#collaborateurs_error');
		const descriptionProjet_error = document.querySelector('#description_projet_error');
		const projet_valide = document.querySelector('#projet_valide');

		// Affichage des valeurs dans la console
		console.log('nom-projet :', nomProjet.value);
		console.log('client :', client.value);
		console.log('contrat :', contrat.value);
		console.log('taux :', taux.value);
		console.log('periode :', periode.value);
		console.log('collaborateurs :', collaborateurs.value);
		console.log('description-projet :', descriptionProjet.value);

		if(!nomProjet.value) {
			nomProjet_error.classList.remove('hidden');
			nb_errors++;
		} else {
			nomProjet_error.classList.add('hidden');
		}
		if(!client.value) {
			client_error.classList.remove('hidden');
			nb_errors++;
		} else {
			client_error.classList.add('hidden');
		}
		if(!contrat.value) {
			contrat_error.classList.remove('hidden');
			nb_errors++;
		} else {
			contrat_error.classList.add('hidden');
		}
		if(!taux.value) {
			taux_error.classList.remove('hidden');
			nb_errors++;
		} else {
			taux_error.classList.add('hidden');
		}
		if(!periode.value) {
			periode_error.classList.remove('hidden');
			nb_errors++;
		} else {
			periode_error.classList.add('hidden');
		}
		if(!collaborateurs.value) {
			collaborateurs_error.classList.remove('hidden');
			nb_errors++;
		} else {
			collaborateurs_error.classList.add('hidden');
		}
		if(!descriptionProjet.value) {
			descriptionProjet_error.classList.remove('hidden');
			nb_errors++;
		} else {
			descriptionProjet_error.classList.add('hidden');
		}

		console.log('nb_errors :', nb_errors);

		if(nb_errors > 0) {
			event.preventDefault();
			projet_valide.classList.add('hidden');
		} else {
			projet_valide.classList.remove('hidden');
			console.log('Projet enregistré');

		}
	});
}

//NOTIFICATIONS GLISSANTES


// Notifications validation/refus ticket client
const notifTicketClient = document.getElementById('notif-ticket-client');
const btnsAccepter = document.querySelectorAll('.btn-accepter');
const btnsRefuser = document.querySelectorAll('.btn-refuser');
if (notifTicketClient && (btnsAccepter.length > 0 || btnsRefuser.length > 0)) {
	btnsAccepter.forEach(btn => {
		btn.addEventListener('click', function() {
			notifTicketClient.textContent = 'Le ticket a été accepté.';
			notifTicketClient.style.display = 'block';
			setTimeout(() => { notifTicketClient.style.display = 'none'; }, 2500);
		});
	});
	btnsRefuser.forEach(btn => {
		btn.addEventListener('click', function() {
			notifTicketClient.textContent = 'Le ticket a été refusé.';
			notifTicketClient.style.display = 'block';
			setTimeout(() => { notifTicketClient.style.display = 'none'; }, 2500);
		});
	});
}


// Notifications suppression utilisateur
const notifUser = document.createElement('div');
notifUser.classList.add('notif');
document.body.appendChild(notifUser);

// Boutons Supprimer dans le tableau utilisateurs
const btnSupprimer = document.querySelectorAll('tbody tr button.btn-supprimer');

btnSupprimer.forEach(btn => {
    btn.addEventListener('click', function() {
        const row = btn.closest('tr'); // la ligne du tableau
        const userName = row.querySelector('td').textContent; // nom de l'utilisateur
        row.remove(); // supprime la ligne du tableau

        // Affiche notification
        notifUser.textContent = `L'utilisateur ${userName} a bien été supprimé.`;
        notifUser.style.display = 'block';
        setTimeout(() => { notifUser.style.display = 'none'; }, 2500);
    });
});

// Notifications suppression projet
const notifProjets = document.createElement('div');
notifProjets.classList.add('notif');
document.body.appendChild(notifProjets);

// Boutons Supprimer dans le tableau projets
const btnSupprimerprojet = document.querySelectorAll('tbody tr button.btn-supprimer-projets');

btnSupprimerprojet.forEach(btn => {
    btn.addEventListener('click', function() {
        const row_proj = btn.closest('tr'); // la ligne du tableau
        const projName = row_proj.querySelector('td').textContent; // nom du projet
        row_proj.remove(); // supprime la ligne du tableau

        // Affiche notification
        notifProjets.textContent = `Le projet ${projName} a bien été supprimé.`;
        notifProjets.style.display = 'block';
        setTimeout(() => { notifProjets.style.display = 'none'; }, 2500);
    });
});

