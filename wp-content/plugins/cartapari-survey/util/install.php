<?php

global $survey_db_version;
$survey_db_version = '1.0';

function create_wp_survey_action_table() {
    global $wpdb;
    global $survey_db_version;
    $table_name = $wpdb->prefix . 'survey_action';
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `action` text NOT NULL,
          PRIMARY KEY (`id`)
        )$charset_collate";
    dbDelta( $sql );
    add_option( 'survey_db_version', $survey_db_version );
}

function create_wp_survey_question_action_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'survey_questions_action';
    $wp_survey_action_table = $wpdb->prefix . 'survey_action';
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
          `survey_questions_action_id` int(11) NOT NULL AUTO_INCREMENT,
          `reference` varchar(20) NOT NULL,
          `requirement` text NOT NULL,
          `action_id` int(11) NOT NULL,
          PRIMARY KEY (`survey_questions_action_id`),
          KEY `fk_action_to_question_pk` (`action_id`),
          CONSTRAINT `fk_action_to_question_pk` FOREIGN KEY (`action_id`) REFERENCES $wp_survey_action_table (`id`)
        )$charset_collate";
    dbDelta( $sql );
}

function create_wp_survey_question_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'survey_questions';
    $wp_survey_questions_action_table = $wpdb->prefix . 'survey_questions_action';
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
          `survey_id` int(11) NOT NULL AUTO_INCREMENT,
          `action_id` int(11) NOT NULL,
          `criterion_parent` text NOT NULL,
          `criterion_child` text NOT NULL,
          PRIMARY KEY (`survey_id`),
          KEY `fk_action_to_question` (`action_id`),
          CONSTRAINT `fk_action_to_question` FOREIGN KEY (`action_id`) REFERENCES $wp_survey_questions_action_table (`survey_questions_action_id`)
        )$charset_collate";
    dbDelta( $sql );
}

function create_wp_survey_answer_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'survey_answer';
    $wp_survey_questions_table = $wpdb->prefix . 'survey_questions';
    $users_table = $wpdb->prefix . 'users';
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
          `id` bigint(20) NOT NULL AUTO_INCREMENT,
          `answer` varchar(5) NOT NULL,
          `note` int(11) DEFAULT NULL,
          `question_id` int(11) NOT NULL,
          `user_id` bigint(20) unsigned DEFAULT NULL,
          PRIMARY KEY (`id`),
          KEY `fk_survey_answer_question_id` (`question_id`),
          KEY `fk_survey_answer_user_id` (`user_id`),
          CONSTRAINT `fk_survey_answer_question_id` FOREIGN KEY (`question_id`) REFERENCES $wp_survey_questions_table (`survey_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
          CONSTRAINT `fk_survey_answer_user_id` FOREIGN KEY (`user_id`) REFERENCES $users_table (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
        )$charset_collate";
    dbDelta( $sql );
}

function initialize_action_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'survey_action';
    $queries = array(
        "INSERT INTO $table_name (`id`,`action`) VALUES (1,'Definire e attuare politiche aziendali che, a partire dal vertice, coinvolgano tutti i livelli dell’organizzazione nel rispetto del principio della pari dignità e trattamento sul lavoro');",
        "INSERT INTO $table_name (`id`,`action`) VALUES (2,'Individuare funzioni aziendali alle quali attribuire chiare responsabilità in materia di pari opportunità');",
        "INSERT INTO $table_name (`id`,`action`) VALUES (3,'Superare gli stereotipi di genere, attraverso adeguate politiche aziendali, formazione\r\ne sensibilizzazione, anche promuovendo i percorsi di carriera');",
        "INSERT INTO $table_name (`id`,`action`) VALUES (4,'Integrare il principio di parità di trattamento nei processi che regolano tutte le fasi della vita professionale e della valorizzazione delle risorse umane, affinché le decisioni relative ad assunzione, formazione e sviluppo di carriera vengano prese unicamente in base alle competenze, all’esperienza, al potenziale professionale delle persone.');",
        "INSERT INTO $table_name (`id`,`action`) VALUES (5,'Sensibilizzare e formare adeguatamente tutti i livelli dell’organizzazione sul valore della diversità e sulle modalità di gestione delle stesse');",
        "INSERT INTO $table_name (`id`,`action`) VALUES (6,'Monitorare periodicamente l’andamento delle pari opportunità e valutarne l’impatto delle buone pratiche.');",
        "INSERT INTO $table_name (`id`,`action`) VALUES (7,'Individuare e fornire al personale strumenti interni a garanzia della effettiva tutela della parità di trattamento');",
        "INSERT INTO $table_name (`id`,`action`) VALUES (8,'Fornire strumenti concreti per favorire la conciliazione dei tempi di vita e di lavoro favorendo l’incontro tra domanda e offerta di flessibilità aziendale e delle persone, anche con adeguate politiche aziendali e contrattuali, in collaborazione con il territorio e la convenzione con i servizi pubblici e privati integrati; assicurando una formazione adeguata al rientro dei congedi parentali');",
        "INSERT INTO $table_name (`id`,`action`) VALUES (9,'Comunicare al personale, con le modalità più opportune, l’impegno assunto a favore di una cultura aziendale della pari opportunità, informandolo sui progetti intrapresi in tali ambiti e sui risultati pratici conseguiti.');",
        "INSERT INTO $table_name (`id`,`action`) VALUES (10,'Promuovere la visibilità esterna dell’impegno aziendale, dando testimonianza delle politiche adottate e dei progressi ottenuti in un’ottica di comunità realmente solidale e responsabile.');",
        "INSERT INTO $table_name (`id`,`action`) VALUES (11,'Target Diversity&Inclusion');"
    );
    foreach($queries as $query){
        $wpdb->query($query);
    }
}

function initialize_question_action_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'survey_questions_action';
    $queries = array(
        "INSERT INTO $table_name (`survey_questions_action_id`,`reference`,`requirement`,`action_id`) VALUES (1,'1.1','Dichiarazioni di impegno della Direzione',1);",
        "INSERT INTO $table_name (`survey_questions_action_id`,`reference`,`requirement`,`action_id`) VALUES (2,'1.2','Strategie, politiche e obiettivi',1);",
        "INSERT INTO $table_name (`survey_questions_action_id`,`reference`,`requirement`,`action_id`) VALUES (3,'2.1','Responsabile D&I quale rappresentante della Direzione',2);",
        "INSERT INTO $table_name (`survey_questions_action_id`,`reference`,`requirement`,`action_id`) VALUES (4,'2.2','Compiti e autorità del Rappresentante',2);",
        "INSERT INTO $table_name (`survey_questions_action_id`,`reference`,`requirement`,`action_id`) VALUES (5,'3.1','Formazione specifica a dirigenti/responsabili ed interventi mirati di valorizzazione',3);",
        "INSERT INTO $table_name (`survey_questions_action_id`,`reference`,`requirement`,`action_id`) VALUES (6,'3.2','Valorizzazione del personale oltre le discriminazioni',3);",
        "INSERT INTO $table_name (`survey_questions_action_id`,`reference`,`requirement`,`action_id`) VALUES (7,'4.1','Gestione non discriminante dei processi chiave relativi alle risorse umane',4);",
        "INSERT INTO $table_name (`survey_questions_action_id`,`reference`,`requirement`,`action_id`) VALUES (8,'4.2','Valutazione non discriminante delle prestazioni per sviluppo carriere e remunerazioni',4);",
        "INSERT INTO $table_name (`survey_questions_action_id`,`reference`,`requirement`,`action_id`) VALUES (9,'5.1','Sensibilizzazione e formazione del personale a tutti i livelli',5);",
        "INSERT INTO $table_name (`survey_questions_action_id`,`reference`,`requirement`,`action_id`) VALUES (10,'5.2','Strumenti adottati e principali temi affrontati',5);",
        "INSERT INTO $table_name (`survey_questions_action_id`,`reference`,`requirement`,`action_id`) VALUES (11,'6.1','Definizione di metriche ed indicatori per il monitoraggio dei progressi',6);",
        "INSERT INTO $table_name (`survey_questions_action_id`,`reference`,`requirement`,`action_id`) VALUES (12,'6.2','Raccolta dati disaggregati quantitativi',6);",
        "INSERT INTO $table_name (`survey_questions_action_id`,`reference`,`requirement`,`action_id`) VALUES (13,'6.3','Raccolta dati disaggregati qualitativi',6);",
        "INSERT INTO $table_name (`survey_questions_action_id`,`reference`,`requirement`,`action_id`) VALUES (14,'6.4','Revisione dei risultati e impatti degli interventi e relative decisioni',6);",
        "INSERT INTO $table_name (`survey_questions_action_id`,`reference`,`requirement`,`action_id`) VALUES (15,'7.1','Attenzione e ascolto',7);",
        "INSERT INTO $table_name (`survey_questions_action_id`,`reference`,`requirement`,`action_id`) VALUES (16,'7.2','Sistema formalizzato raccolta denunce',7);",
        "INSERT INTO $table_name (`survey_questions_action_id`,`reference`,`requirement`,`action_id`) VALUES (17,'8.1','Flessibilità del lavoro',8);",
        "INSERT INTO $table_name (`survey_questions_action_id`,`reference`,`requirement`,`action_id`) VALUES (18,'8.2','Supporti per la conciliazione',8);",
        "INSERT INTO $table_name (`survey_questions_action_id`,`reference`,`requirement`,`action_id`) VALUES (19,'8.3','La gestione dei lunghi congedi',8);",
        "INSERT INTO $table_name (`survey_questions_action_id`,`reference`,`requirement`,`action_id`) VALUES (20,'9.1','La comunicazione interna',9);",
        "INSERT INTO $table_name (`survey_questions_action_id`,`reference`,`requirement`,`action_id`) VALUES (21,'10.1','Comunicazione esterna ',10);",
        "INSERT INTO $table_name (`survey_questions_action_id`,`reference`,`requirement`,`action_id`) VALUES (22,'10.2','Rapporti con le istituzioni e il territorio',10);",
        "INSERT INTO $table_name (`survey_questions_action_id`,`reference`,`requirement`,`action_id`) VALUES (23,'','Nello specifico le iniziative che avete avviato o che state inviando nella vostra organizzazione verso quale ambito di Diversity & Inclusion si sono indirizzate (possibilità di risposta multipla)?',11);");
    foreach($queries as $query){
        $wpdb->query($query);
    }
}


function initialize_question_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'survey_questions';
    $queries = array
    (
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (8,1,'La Direzione aziendale definisce e comunica l’orientamento politico generale aziendale in tema di Diversity&Inclusion sotto forma di:\r\na) valorizzazione di politiche già in atto\r\nb) nuova politica di D&I sottoscritta dal vertice aziendale\r\nc) inclusione nel codice etico dei principi di Diversity&Inclusion\r\nd) richiamo al preambolo e al decalogo di azioni concrete della Carta delle Pari Opportunità e l\'Uguaglianza sul Lavoro\r\ne) altro (specificare nelle note)','');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (9,2,'La Direzione aziendale decide strategie e politiche annuali in tema di Diversity&Inclusion e coerentemente pianifica gli interventi determinando obiettivi, indicatori chiave, tempi, risorse, responsabilità.','');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (10,3,'La Direzione aziendale nomina e dà autorità a un/a suo rappresentante quale responsabile dello sviluppo e dell’ implementazione delle politiche della Direzione, a cui sono assegnati annualmente obiettivi e risorse.\r\nHa assunto questa responsabilità:\r\na) capo azienda o imprenditore (PMI)\r\nb) apposito comitato di Direzione/steering committee\r\nc) direzione risorse umane\r\nd) gruppo di lavoro multifunzionale\r\ne) comitato/commissione paritetica PO/D&I\r\nf) Diversity manager\r\ng) Consigliere del CdA\r\nh) altro (specificare in Note)','');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (11,4,'Il responsabile presenta alla Direzione un report annuale relativo allo sviluppo e al monitoraggio degli interventi su cui la Direzione basa politiche ed obiettivi dell’anno successivo.','');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (12,5,'Dopo aver individuato i pregiudizi che ostacolano la valorizzazione delle lavoratrici, la Direzione aziendale ha previsto una formazione specifica a dirigenti/responsabili per garantire la parità di accesso a tutti i livelli di istruzione e formazione professionale.','');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (13,6,'La Direzione aziendale promuove una maggior presenza di donne, garantendo la loro piena ed effettiva partecipazione e pari opportunità di leadership a tutti i livelli del processo decisionale nella vita aziendale.','');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (14,7,'Sono stati rivisitati i processi che hanno particolare attinenza con le principali categorie di diversità, secondo principi di pari opportunità e valorizzazione delle differenze. In particolare:','assunzioni gestite con modalità trasparenti e non discriminatorie');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (15,7,'formazione resa equamente accessibile a tutto il personale','formazione resa equamente accessibile a tutto il personale');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (16,7,'Sono stati rivisitati i processi che hanno particolare attinenza con le principali categorie di diversità, secondo principi di pari opportunità e valorizzazione delle differenze. In particolare:','azioni positive adottate a favore di gruppi potenzialmente discriminati');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (17,7,'Sono stati rivisitati i processi che hanno particolare attinenza con le principali categorie di diversità, secondo principi di pari opportunità e valorizzazione delle differenze. In particolare:','CdA Inclusivi e rappresentativi');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (18,8,'L\'organizzazione adotta modalità di valutazione che prevengono e superano gli stereotipi (relativi a genere, età, etnia, fede religiosa, orientamento sessuale) ed ogni possibile forma di penalizzazione garantendo a tutti pari opportunità. In particolare, sono adottate modalità che rendano la valutazione trasparente e non penalizzante verso categorie a rischio:','promozione di processi di selezione e sviluppo trasparenti ed inclusivi');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (19,8,'L\'organizzazione adotta modalità di valutazione che prevengono e superano gli stereotipi (relativi a genere, età, etnia, fede religiosa, orientamento sessuale) ed ogni possibile forma di penalizzazione garantendo a tutti pari opportunità. In particolare, sono adottate modalità che rendano la valutazione trasparente e non penalizzante verso categorie a rischio:','analisi dei livelli i retribuitivi per la stessa posizione e azioni correttive');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (20,8,'L\'organizzazione adotta modalità di valutazione che prevengono e superano gli stereotipi (relativi a genere, età, etnia, fede religiosa, orientamento sessuale) ed ogni possibile forma di penalizzazione garantendo a tutti pari opportunità. In particolare, sono adottate modalità che rendano la valutazione trasparente e non penalizzante verso categorie a rischio:','possibilità di ricorso contro valutazioni ritenute discriminanti');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (21,8,'L\'organizzazione adotta modalità di valutazione che prevengono e superano gli stereotipi (relativi a genere, età, etnia, fede religiosa, orientamento sessuale) ed ogni possibile forma di penalizzazione garantendo a tutti pari opportunità. In particolare, sono adottate modalità che rendano la valutazione trasparente e non penalizzante verso categorie a rischio:','altro (specificare in Note)');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (22,9,'L\'organizzazione riconosce la sensibilizzazione e la formazione come presupposti essenziali per il successo delle politiche di D&I. Tutto il personale è sensibilizzato in tema di pari opportunità e valore delle diversità con adeguati interventi e strumenti, diversificati e calibrati in base a ruolo e responsabilità. In particolare l’azienda:','ha avviato alcune iniziative, ma senza legarle tra di loro e includerle in un disegno organico');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (23,9,'L\'organizzazione riconosce la sensibilizzazione e la formazione come presupposti essenziali per il successo delle politiche di D&I. Tutto il personale è sensibilizzato in tema di pari opportunità e valore delle diversità con adeguati interventi e strumenti, diversificati e calibrati in base a ruolo e responsabilità. In particolare l’azienda:','ha puntato inizialmente su funzioni direzionali e responsabili delle pratiche di gestione risorse umane');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (24,9,'L\'organizzazione riconosce la sensibilizzazione e la formazione come presupposti essenziali per il successo delle politiche di D&I. Tutto il personale è sensibilizzato in tema di pari opportunità e valore delle diversità con adeguati interventi e strumenti, diversificati e calibrati in base a ruolo e responsabilità. In particolare l’azienda:','ha iniziato un piano sistematico che a cascata investa tutti i livelli');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (25,9,'L\'organizzazione riconosce la sensibilizzazione e la formazione come presupposti essenziali per il successo delle politiche di D&I. Tutto il personale è sensibilizzato in tema di pari opportunità e valore delle diversità con adeguati interventi e strumenti, diversificati e calibrati in base a ruolo e responsabilità. In particolare l’azienda:','altro (specificare in Note)');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (26,10,'L’azienda ha avviato i seguenti programmi:','partecipazione a formazione esterna, seminari, corsi\r\nc) moduli di e-learning');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (27,10,'L’azienda ha avviato i seguenti programmi:','partecipazione a incontri esterni di sensibilizzazione, scambi di esperienze\r\nd) organizzazione per tutto il personale di eventi di sensibilizzazione');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (28,10,'L’azienda ha avviato i seguenti programmi:','gruppi di lavoro tematici, laboratori formativi per manager');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (29,10,'L’azienda ha avviato i seguenti programmi:','approfondimenti su come gestire praticamente problematiche e situazioni legate ai temi D&I\r\nh) aspetti specifici di discriminazione relativi a: disabilità, genere, età, origine etnica, orientamento sessuale');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (31,11,'L\'organizzazione ha sviluppato dei sistemi di monitoraggio dei risultati per misurare il livello di raggiungimento dei target Diversity&Inclusion.','');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (32,12,'Vengono rilevati e analizzati i principali risultati qualitativi delle azioni attuate in termini di clima, esperienze, buone pratiche.','');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (33,13,'Vengono rilevati e analizzati i principali risultati qualitativi delle azioni attuate in termini di clima, esperienze, buone pratiche.','');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (34,14,'Viene monitorato lo stato di avanzamento del piano e pianificati gli eventuali interventi correttivi.','');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (35,14,'Vengono valutati i risultati e gli impatti prodotti (anche dal punto di vista economico).','');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (36,15,'L\'organizzazione attiva strumenti di ascolto di tutte le parti interessate.','');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (37,16,'L’organizzazione ha un sistema formalizzato, adeguatamente promosso tra i dipendenti e di facile accesso, per la raccolta delle denunce per discriminazioni, di qualsiasi tipo e gravità, legate al genere, all’età, all’etnia, alla fede religiosa o all’orientamento sessuale.','');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (38,17,'L’azienda ha attuato iniziative per la soddisfazione dei bisogni in termini di flessibilità del lavoro dei propri dipendenti.\r\nIn particolare attraverso:\r\na) accordi contrattuali diretti con lavoratrici/lavoratori\r\nb) accordi di natura sindacale e collettiva','');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (39,17,'con quale delle seguenti forme?','contratti a tempo parziale ');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (40,17,'con quale delle seguenti forme?','flessibilità degli orari di lavoro');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (41,17,'con quale delle seguenti forme?','telelavoro, smart working e lavoro agile');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (42,17,'con quale delle seguenti forme?','banca delle ore');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (44,18,'L’azienda individua uno o più supporti alla conciliazione organizzati anche in collaborazione con istituzioni, terzo settore, altre imprese, nelle seguenti forme:','servizi / sportelli di ascolto e consulenza');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (45,18,'L’azienda individua uno o più supporti alla conciliazione organizzati anche in collaborazione con istituzioni, terzo settore, altre imprese, nelle seguenti forme:','asili nido aziendali');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (46,18,'L’azienda individua uno o più supporti alla conciliazione organizzati anche in collaborazione con istituzioni, terzo settore, altre imprese, nelle seguenti forme:','convenzioni per servizi di assistenza/welfare');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (47,18,'L’azienda individua uno o più supporti alla conciliazione organizzati anche in collaborazione con istituzioni, terzo settore, altre imprese, nelle seguenti forme:','maggiordomo aziendale: disbrigo pratiche, servizi lavanderia/spesa');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (48,18,'L’azienda individua uno o più supporti alla conciliazione organizzati anche in collaborazione con istituzioni, terzo settore, altre imprese, nelle seguenti forme:','contributi alle spese di cura, benefit aziendali');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (49,18,'L’azienda individua uno o più supporti alla conciliazione organizzati anche in collaborazione con istituzioni, terzo settore, altre imprese, nelle seguenti forme:','servizi di trasporto');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (50,18,'L’azienda individua uno o più supporti alla conciliazione organizzati anche in collaborazione con istituzioni, terzo settore, altre imprese, nelle seguenti forme:','accordi con altre imprese per dividere i costi dei servizi');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (51,18,'L’azienda individua uno o più supporti alla conciliazione organizzati anche in collaborazione con istituzioni, terzo settore, altre imprese, nelle seguenti forme:','reti territoriali di conciliazione con istituzione e altre imprese');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (52,18,'L’azienda individua uno o più supporti alla conciliazione organizzati anche in collaborazione con istituzioni, terzo settore, altre imprese, nelle seguenti forme:','altro (specificare in Note)');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (53,19,'La gestione dei lunghi congedi richiede una pianificazione strutturata prima, durante e dopo.\r\nQuali sono stati i piani attivati dall’azienda in merito?','pre-congedo, stesura piano di congedo e carriera post rientro');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (54,19,'La gestione dei lunghi congedi richiede una pianificazione strutturata prima, durante e dopo.\r\nQuali sono stati i piani attivati dall’azienda in merito?','supporto e aggiornamento per mantenere i contatti e facilitare il rientro');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (55,19,'La gestione dei lunghi congedi richiede una pianificazione strutturata prima, durante e dopo.\r\nQuali sono stati i piani attivati dall’azienda in merito?','formazione specifica per reinserimento dopo congedo di maternità');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (56,19,'La gestione dei lunghi congedi richiede una pianificazione strutturata prima, durante e dopo.\r\nQuali sono stati i piani attivati dall’azienda in merito?','formazione capi diretti per la relazione e il reinserimento dopo congedo');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (57,19,'La gestione dei lunghi congedi richiede una pianificazione strutturata prima, durante e dopo.\r\nQuali sono stati i piani attivati dall’azienda in merito?','altro (specificare in Note)');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (58,20,'Gli strumenti adottati dall\'organizzazione per comunicare a tutto il personale il proprio impegno per la tutela e la promozione delle pari opportunità e la valorizzazione delle diversità in azienda, gli interventi/progetti realizzati ed i risultati ottenuti sono in particolare:\r\na) lettere, disposizioni generali, circolari di direzione\r\nb) intranet\r\nc) stampa/newseltter aziendale\r\nd) affissioni in bacheca\r\ne) documentazione per nuovi assunti\r\nf) altro (specificare in Note)','');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (59,20,'In particolare viene comunicato: \r\na) impegno della direzione\r\nb) interventi/progetti realizzati e risultati ottenuti\r\nc) nuovi servizi offerti\r\nd) altro (specificare in Note)','');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (60,21,'L’organizzazione comunica all’esterno le sue politiche e gli interventi in tema di Diversity&Inclusion, a tutti i suoi stakeholder , in particolare ai referenti istituzionali, ai fornitori, ai clienti, agli azionisti attraverso:\r\na) sito internet e sue sezioni dedicate\r\nb) partecipazione/organizzazione di convegni\r\nc) partecipazione a premi/award\r\nd) condivisione pratiche attraverso reti specializzate\r\ne) altro (specificare in Note)','');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (61,22,'La Direzione e i responsabili instaurano rapporti stabili con referenti istituzionali e non per concordare:\r\na) la realizzazione congiunta con altre imprese locali di un nuovo servizio\r\nb) accordi territoriali per costituire reti di servizi\r\nc) interventi a favore di una migliore qualità di vita e di lavoro (housing, trasporti…)\r\nd) altro (specificare in Note)','');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (62,23,'Donne','');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (63,23,'Giovani','');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (64,23,'Senior','');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (65,23,'Disabili','');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (66,23,'Minoranze etniche','');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (67,23,'Minoranze religiose','');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (68,23,'LGBT','');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (69,23,'Altro (specificare in Note)','');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (70,7,'Sono stati rivisitati i processi che hanno particolare attinenza con le principali categorie di diversità, secondo principi di pari opportunità e valorizzazione delle differenze. In particolare:','altro (specificare in Note)');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (71,17,'con quale delle seguenti forme?','accordi territoriali per servizi alla persona');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (72,10,'L’azienda ha avviato i seguenti programmi:','introduzione di temi generali come rischi legali, vantaggi e sfide della D&I');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (73,10,'L’azienda ha avviato i seguenti programmi:','altro (specificare in Note)');",
        "INSERT INTO $table_name (`survey_id`,`action_id`,`criterion_parent`,`criterion_child`) VALUES (74,17,'con quale delle seguenti forme?','altro (specificare in Note)');"
    );
    foreach($queries as $query){
        $wpdb->query($query);
    }
}

function drop_tables(){
    global $wpdb;
    $sql = "DROP TABLE IF EXISTS ".$wpdb->prefix."survey_answer;";
    $wpdb->query($sql);
    $sql = "DROP TABLE IF EXISTS ".$wpdb->prefix."survey_questions;";
    $wpdb->query($sql);
    $sql = "DROP TABLE IF EXISTS ".$wpdb->prefix."survey_questions_action;";
    $wpdb->query($sql);
    $sql = "DROP TABLE IF EXISTS ".$wpdb->prefix."survey_action;";
    $wpdb->query($sql);
    delete_option( 'survey_db_version');
}

function createRequiredTables(){
    drop_tables();
    create_wp_survey_action_table();
    create_wp_survey_question_action_table();
    create_wp_survey_question_table();
    create_wp_survey_answer_table();
    initialize_action_table();
    initialize_question_action_table();
    initialize_question_table();
}