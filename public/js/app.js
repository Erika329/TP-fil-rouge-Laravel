// TP Fil Rouge - front-end helpers

window.triggerSubmit = function (form) {
    if (!form) {
        return;
    }

    if (typeof form.requestSubmit === 'function') {
        form.requestSubmit();
        return;
    }

    form.submit();
};

function setError(selector, visible, message) {
    const element = document.querySelector(selector);
    if (!element) {
        return;
    }

    if (message) {
        element.textContent = message;
    }

    element.classList.toggle('hidden', !visible);
}

function validEmail(value) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
}

function bindLoginForm() {
    const form = document.querySelector('#submitform');
    if (!form) return;

    form.addEventListener('submit', function (event) {
        const email = document.querySelector('#identifiant');
        const password = document.querySelector('#mot_de_passe');
        const success = document.querySelector('#connexion_valide');

        const emailMissing = !email || !email.value.trim();
        const passwordMissing = !password || !password.value.trim();
        const hasErrors = emailMissing || passwordMissing;

        setError('#identifiant_error', emailMissing, "L'email est obligatoire.");
        setError('#mdp_error', passwordMissing, 'Le mot de passe est obligatoire.');

        if (success) {
            success.classList.toggle('hidden', hasErrors);
        }

        if (hasErrors) {
            event.preventDefault();
        }
    });
}

function bindForgotForm() {
    const form = document.querySelector('#forgotform');
    if (!form) return;

    form.addEventListener('submit', function (event) {
        const email = document.querySelector('#email');
        const success = document.querySelector('#mail_valide');
        let hasErrors = false;

        if (!email || !email.value.trim()) {
            setError('#email_error', true, "L'email est obligatoire.");
            hasErrors = true;
        } else if (!validEmail(email.value.trim())) {
            setError('#email_error', true, 'Veuillez saisir un email valide.');
            hasErrors = true;
        } else {
            setError('#email_error', false);
        }

        if (success) {
            success.classList.toggle('hidden', hasErrors);
        }

        if (hasErrors) {
            event.preventDefault();
        }
    });
}

function bindRegisterForm() {
    const form = document.querySelector('#createform');
    if (!form) return;

    form.addEventListener('submit', function (event) {
        const firstName = document.querySelector('#prenom');
        const lastName = document.querySelector('#nom');
        const email = document.querySelector('#email');
        const role = document.querySelector('#role');
        const password = document.querySelector('#mot_de_passe');
        const confirmation = document.querySelector('#password_confirmation');
        const success = document.querySelector('#creation_valide');

        let errors = 0;

        if (!firstName || !firstName.value.trim()) {
            setError('#prenom_error', true, 'Le prenom est obligatoire.');
            errors++;
        } else {
            setError('#prenom_error', false);
        }

        if (!lastName || !lastName.value.trim()) {
            setError('#nom_error', true, 'Le nom est obligatoire.');
            errors++;
        } else {
            setError('#nom_error', false);
        }

        if (!email || !email.value.trim()) {
            setError('#email_error', true, "L'email est obligatoire.");
            errors++;
        } else if (!validEmail(email.value.trim())) {
            setError('#email_error', true, 'Veuillez saisir un email valide.');
            errors++;
        } else {
            setError('#email_error', false);
        }

        if (!role || !role.value.trim()) {
            setError('#role_error', true, 'Le role est obligatoire.');
            errors++;
        } else {
            setError('#role_error', false);
        }

        if (!password || !password.value.trim()) {
            setError('#mdp_error', true, 'Le mot de passe est obligatoire.');
            errors++;
        } else {
            setError('#mdp_error', false);
        }

        if (!confirmation || !confirmation.value.trim() || confirmation.value !== password.value) {
            setError('#password_confirmation_error', true, 'La confirmation doit correspondre au mot de passe.');
            errors++;
        } else {
            setError('#password_confirmation_error', false);
        }

        if (success) {
            success.classList.toggle('hidden', errors > 0);
        }

        if (errors > 0) {
            event.preventDefault();
        }
    });
}

function bindTicketForm() {
    const form = document.querySelector('#ticket-form');
    if (!form) return;

    form.addEventListener('submit', function (event) {
        const requiredFields = [
            ['#titre', '#titre_error', 'Le titre est obligatoire.'],
            ['#projet', '#projet_error', 'Le projet est obligatoire.'],
            ['#description', '#description_error', 'La description est obligatoire.'],
            ['#type', '#type_error', 'Le type est obligatoire.'],
            ['#statut', '#statut_error', 'Le statut est obligatoire.'],
        ];

        let errors = 0;

        requiredFields.forEach(function ([fieldSelector, errorSelector, message]) {
            const field = document.querySelector(fieldSelector);
            const empty = !field || !field.value.trim();
            setError(errorSelector, empty, message);
            if (empty) {
                errors++;
            }
        });

        if (errors > 0) {
            event.preventDefault();
        }
    });
}

function bindProjectForm() {
    const form = document.querySelector('#projectform');
    if (!form) return;

    form.addEventListener('submit', function (event) {
        const requiredFields = [
            ['#nom-projet', '#nom_projet_error', 'Le nom du projet est obligatoire.'],
            ['#client', '#client_error', 'Le client est obligatoire.'],
            ['#contrat', '#contrat_error', 'Le type de contrat est obligatoire.'],
            ['#heures', '#heures_error', "Le nombre d'heures est obligatoire."],
            ['#statut', '#statut_error', 'Le statut est obligatoire.'],
        ];

        let errors = 0;

        requiredFields.forEach(function ([fieldSelector, errorSelector, message]) {
            const field = document.querySelector(fieldSelector);
            const empty = !field || !field.value.trim();
            setError(errorSelector, empty, message);
            if (empty) {
                errors++;
            }
        });

        if (errors > 0) {
            event.preventDefault();
        }
    });
}

function bindProfileForm() {
    const form = document.querySelector('#profile-form');
    if (!form) return;

    form.addEventListener('submit', function (event) {
        const name = document.querySelector('#nom');
        const email = document.querySelector('#email');
        let errors = 0;

        if (!name || !name.value.trim()) {
            setError('#nom_error', true, 'Le nom est obligatoire.');
            errors++;
        } else {
            setError('#nom_error', false);
        }

        if (!email || !email.value.trim()) {
            setError('#email_error', true, "L'email est obligatoire.");
            errors++;
        } else if (!validEmail(email.value.trim())) {
            setError('#email_error', true, 'Veuillez saisir un email valide.');
            errors++;
        } else {
            setError('#email_error', false);
        }

        if (errors > 0) {
            event.preventDefault();
        }
    });
}

function filterTable(config) {
    if (!config.tbody) return;

    const rows = config.tbody.querySelectorAll('tr');
    const searchValue = config.search ? config.search.value.trim().toLowerCase() : '';

    rows.forEach(function (row) {
        const cells = row.querySelectorAll('td');
        let visible = true;

        if (searchValue && config.searchColumns) {
            const match = config.searchColumns.some(function (index) {
                return cells[index] && cells[index].textContent.toLowerCase().includes(searchValue);
            });

            if (!match) {
                visible = false;
            }
        }

        if (visible && config.selectFilters) {
            config.selectFilters.forEach(function (filter) {
                const selected = filter.element ? filter.element.value.trim().toLowerCase() : '';
                const cellText = cells[filter.column] ? cells[filter.column].textContent.trim().toLowerCase() : '';

                if (selected && !cellText.includes(selected)) {
                    visible = false;
                }
            });
        }

        row.style.display = visible ? '' : 'none';
    });
}

function bindTicketFilters() {
    const form = document.querySelector('#filtre-tickets-form');
    const tbody = document.querySelector('#tickets-table tbody');
    if (!form || !tbody) return;

    const config = {
        tbody: tbody,
        search: document.querySelector('#recherche-ticket'),
        searchColumns: [0, 1],
        selectFilters: [
            { element: document.querySelector('#filtre-statut'), column: 3 },
            { element: document.querySelector('#filtre-projet'), column: 2 },
            { element: document.querySelector('#filtre-type'), column: 5 },
        ],
    };

    form.addEventListener('submit', function (event) {
        event.preventDefault();
        filterTable(config);
    });

    if (config.search) {
        config.search.addEventListener('input', function () {
            filterTable(config);
        });
    }
}

function bindProjectFilters() {
    const form = document.querySelector('#filtre-projets-form');
    const tbody = document.querySelector('#projects-table tbody');
    if (!form || !tbody) return;

    const config = {
        tbody: tbody,
        search: document.querySelector('#recherche-projet'),
        searchColumns: [0],
        selectFilters: [
            { element: document.querySelector('#filtre-statut'), column: 1 },
            { element: document.querySelector('#filtre-projet'), column: 4 },
        ],
    };

    form.addEventListener('submit', function (event) {
        event.preventDefault();
        filterTable(config);
    });

    if (config.search) {
        config.search.addEventListener('input', function () {
            filterTable(config);
        });
    }
}

bindLoginForm();
bindForgotForm();
bindRegisterForm();
bindTicketForm();
bindProjectForm();
bindProfileForm();
bindTicketFilters();
bindProjectFilters();
