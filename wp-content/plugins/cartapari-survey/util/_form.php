<?php
$states = array("AG","AL","AN","AO","AQ","AR","AP","AT","AV","BA","BT","BL","BN","BG","BI","BO","BZ","BS","BR","CA",
    "CL","CB","CI","CE","CT","CZ","CH","CO","CS","CR","KR","CN","EN","FM","FE","FI","FG","FC","FR","GE","GO","GR",
    "IM","IS","SP","LT","LE","LC","LI","LO","LU","MC","MN","MS","MT","VS","ME","MI","MO","MB","NA","NO","NU","OG","OT",
    "OR","PD","PA","PR","PV","PG","PU","PE","PC","PI","PT","PN","PZ","PO","RG","RA","RC","RE","RI","RN","Roma","RO",
    "SA","SS","SV","SI","SR","SO","TA","TE","TR","TO","TP","TN","TV","TS","UD","VA","VE","VB","VC","VR","VV","VI","VT");
$sectors = array("Agricoltura-altri settori rurali","Alimentari-bevande-tabacco","Altri Servizi","Ambiente",
    "Assistenza sociale","Assistenza sociale e protezione civile","Attività finanziarie e assicurative",
    "Chimico e farmaceutico","Commercio all’ingrosso e al dettaglio","Cooperazione e solidarietà internazionale",
    "Cultura-sport-ricreazione","Fornitura di energia elettrica, gas, acqua","Istruzione – ricerca",
    "Manifatturiero","Media-grafica","Pubblica amministrazione","Relazioni sindacali e rappresentanza interessi",
    "Sanità","Sviluppo economico e coesione sociale","Telecomunicazioni","Trasporti","Turistico","Altro (specificare)");
?>
<style>

    .form-design{
        max-width: 98% !important;
        width: 98% !important;
        font-size: 12px !important;
    }
    .form-design table{
        padding: 15px !important;
        margin: 30px 10px 10px !important;
    }
    #main-form-table {
        border-collapse: collapse !important;
    }
    #companyDataTable th{
        border: 0 !important;
        margin-right: 30px !important;
        margin-top: 15px !important;
    }
    #companyDataTable td{
        border: 0 !important;
        padding-right: 20px !important;
    }
    #main-form-table td {
        border: 1px solid #333 !important;
        padding: 5px !important;
        font-size: 12px;
    }
    #companyDataTable th{
        float: left !important;
    }
    #companyDataTable select, #companyDataTable input[type='text'], #companyDataTable input[type='date'],
    #companyDataTable textarea, #companyDataTable input[type='email'], #main-form-table textarea{
        width:100% !important;
        box-sizing:border-box !important;
        margin-top: 5px !important;
    }
    caption{
        padding: 20px !important;
        font-size: 20px !important;
    }
    #companyDataTable textarea::placeholder {
        color: #444 !important;
        text-align: center !important;
        overflow: hidden !important;
        font-size: 12px !important;
    }
    #main-form-table textarea::placeholder {
        text-align: center !important;
        font-size: 12px !important;
        line-height: 1em !important;
    }
    #form_render_id{
        margin-top: 10px;
    }
    .company-data-trigger{
        background-color: #eee;
        height: 40px;
        line-height: 40px;
        margin: 30px 10px 10px !important;
    }
    .section-toggle{
        font-size: 16px;
        padding: 5px;
        color: #0275d8;
        text-decoration: none;
        cursor: pointer;
        font-weight: 400;
    }
    .form-submit-button{
        margin-left: 10px;
    }
    .header-main{
        font-size: 14px !important;
    }
    #main-form-table .text-area-class {
        width: 20% !important;
    }
</style>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"/>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<h2>Guida alla compilazione</h2>
<p>Comincia compilando i dati societari, poi clicca in ordine sui diversi punti del questionario per aprire la sezione relativa.
    È necessario rispondere a tutte le domande prima di inviare il questionario.</p>


<form action = '<?php echo admin_url('admin-post.php') ?>' method = 'post' id = 'form_render_id' class = 'form-design'>
    <div class="company-data-trigger">
        <a class="section-toggle" data-toggle="collapse" href="#companyDataTable" role="button" aria-expanded="false" aria-controls="companyDataTable">
            Dati societari
        </a>
    </div>
    <table class="collapse show" id='companyDataTable'>
        <tbody>
        <tr>
            <th>NOME AZIENDA</th>
            <td><input type='text' name='company_name' placeholder='Nome Azienda' required='required'/></td>
        </tr>
        <tr>
            <th>TIPOLOGIA ORGANIZZAZIONE</th>
            <td>
                <select name='company_type' required='required'>
                    <option value='IMPRESA-ASSOCIAZIONE IMPRENDITORIALE'>IMPRESA-ASSOCIAZIONE IMPRENDITORIALE</option>
                    <option value='ENTE PUBBLICO'>ENTE PUBBLICO</option>
                    <option value='TERZO SETTORE E SOCIETA'>TERZO SETTORE E SOCIETA' CIVILE</option>
                </select>
            </td>
        </tr>
        <tr>
            <th>SETTORE</th>
            <td>
                <select name='sector' required='required'>
                    <?php foreach ($sectors as $sector){
                        echo "<option value='$sector'>$sector</option>";
                    }?>
                    "</select>
            </td>
        </tr>
        <tr>
            <td></td>
            <td id="sector-td"></td>
        </tr>
        <tr>
            <th>NUMERO DI DIPENDENTI</th>
            <td>
                <select name='no_of_employee' required='required'>
                    <option value='0-10'>0-10</option>
                    <option value='11-50'>11-50</option>
                    <option value='51-250'>51-250</option>
                    <option value='251-1000'>251-1000</option>
                    <option value='1001-5000'>1001-5000</option>
                    <option value='Oltre 5000'>Oltre 5000</option>
                </select>
            </td>
        </tr>
        <tr>
            <th>PROVINCIA</th>
            <td>
                <select name='state' required='required'>
                    <?php foreach ($states as $state){
                        echo "<option value='$state'>$state</option>";
                    }?>
                </select>
            </td>
        </tr>
        <tr>
            <th>PERSONA INCARICATA DELLA COMPILAZIONE</th>
            <td><input type='text' name='author' placeholder='Name and Role' required='required'/></td>
        </tr>
        <tr>
            <th>EMAIL PER RICEZIONE RISULTATI</th>
            <td><input type='email' name='author_email' placeholder='EMAIL PER RICEZIONE RISULTATI' required='required'/></td>
        </tr>
        <tr>
            <th>DATA DELLA COMPILAZIONE</th>
            <td><input type='date' name='issued_date' placeholder='Date of Issue' required='required'/></td>
        </tr>

        </tbody>
    </table>

    <table id = 'main-form-table'>
        <thead class="d-none table-header"><th>RIFERIMENTO</th><th>REQUISITO</th><th>CRITERIO</th><th></th><th>RISPOSTA</th><th>Note</th></thead>
        <tbody>
        <tr>
            <td colspan="7" class="header-main">
                <a class="section-toggle" data-toggle="collapse" href="#section1" role="button" aria-expanded="false" aria-controls="section1">
                    Punto 1
                </a>
                | Definire e attuare politiche aziendali che, a partire dal vertice, coinvolgano tutti i
                    livelli dell’organizzazione nel rispetto del principio della pari dignità e trattamento sul lavoro
            </td>
        </tr>
        <tbody class="collapse" id="section1">
        <tr>
            <td width="5%">
                1.1
            </td>
            <td>
                Dichiarazioni di impegno della Direzione
            </td>
            <td colspan = '2'>
                La Direzione aziendale definisce e comunica l’orientamento politico generale
                aziendale in tema di Diversity&Inclusion sotto forma di:<br>
                a) valorizzazione di politiche già in atto <br>
                b) nuova politica di D&I sottoscritta dal vertice aziendale <br>
                c) inclusione nel codice etico dei principi di Diversity&Inclusion <br>
                d) richiamo al preambolo e al decalogo di azioni concrete della Carta delle Pari Opportunità e l'Uguaglianza sul Lavoro <br>
                e) altro (specificare nelle note)<br>
            </td>
            <td>
                <select required='required' name='select_1'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>
            <td class="text-area-class">
                <textarea rows='4' placeholder='Specificare quali delle opzioni indicate sono state implementate, se si è scelto `altro`, indicare esplicitamente di cosa si tratta'
                          name = 'note_1' id='note_1'></textarea>
            </td>
        </tr>
        <tr>
            <td>
                1.2
            </td>
            <td>
                Strategie, politiche e obiettivi
            </td>
            <td colspan = '2'>
                La Direzione aziendale decide strategie e politiche annuali in tema
                di Diversity&Inclusion e coerentemente pianifica gli interventi determinando
                obiettivi, indicatori chiave, tempi, risorse, responsabilità.
            </td>
            <td>
                <select required='required' name='select_2'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>
            <td class="text-area-class">
                <textarea rows='4' placeholder='Commento libero non obbligatorio' name = 'note_2' id='note_2'></textarea>
            </td>
        </tr>
        </tbody>
        <tr>
            <td colspan="7" class="header-main">
                <a class="section-toggle" data-toggle="collapse" href="#section2" role="button" aria-expanded="false" aria-controls="section2">
                    Punto 2
                </a>
                | Individuare funzioni aziendali alle quali attribuire chiare
                    responsabilità in materia di pari opportunità
            </td>
        </tr>
        <tbody class="collapse" id="section2">
        <tr>
            <td>
                2.1
            </td>
            <td>
                Responsabile D&I quale rappresentante della Direzione
            </td>
            <td colspan = '2'>
                La Direzione aziendale nomina e dà autorità a un/a suo rappresentante quale
                responsabile dello sviluppo e dell’ implementazione delle politiche della Direzione,
                a cui sono assegnati annualmente obiettivi e risorse. Ha assunto questa responsabilità: <br>
                a) capo azienda o imprenditore (PMI)<br>
                b) apposito comitato di Direzione/steering committee<br>
                c) direzione risorse umane<br>
                d) gruppo di lavoro multifunzionale<br>
                e) comitato/commissione paritetica PO/D&I<br>
                f) Diversity manager<br>
                g) Consigliere del CdA<br>
                h) altro (specificare in Note)<br>

            </td>
            <td>
                <select required='required' name='select_3'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>
            <td class="text-area-class">
                <textarea rows='4' placeholder='Specificare a quale delle opzioni indicate si fa riferimento. Se si è scelto `altro`, indicare esplicitamente il ruolo della persona che ha assunto la responsabilità'
                          name = 'note_3' id ='note_3'></textarea>
            </td>
        </tr>
        <tr>
            <td>
                2.2
            </td>
            <td>
                Compiti e autorità del Rappresentante
            </td>
            <td colspan = '2'>
                Il responsabile presenta alla Direzione un report annuale relativo
                allo sviluppo e al monitoraggio degli interventi su cui la Direzione
                basa politiche ed obiettivi dell’anno successivo.
            </td>
            <td>
                <select required='required' name='select_4'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>
            <td class="text-area-class">
                <textarea rows='4' placeholder='Commento libero non obbligatorio' name = 'note_4' id ='note_4'></textarea>
            </td>
        </tr>
        </tbody>
        <tr>
            <td colspan="7" class="header-main">
                <a class="section-toggle" data-toggle="collapse" href="#section3" role="button" aria-expanded="false" aria-controls="section3">
                    Punto 3
                </a>
                | Superare gli stereotipi di genere, attraverso adeguate politiche aziendali,
                    formazione e sensibilizzazione, anche promuovendo i percorsi di carriera
            </td>
        </tr>
        <tbody class="collapse" id="section3">
        <tr>
            <td>
                3.1
            </td>
            <td>
                Formazione specifica a dirigenti/responsabili ed interventi mirati di valorizzazione
            </td>
            <td colspan = '2'>
                Dopo aver individuato i pregiudizi che ostacolano la valorizzazione delle lavoratrici,
                la Direzione aziendale ha previsto una formazione specifica a dirigenti/responsabili per
                garantire la parità di accesso a tutti i livelli di istruzione e formazione professionale.
            </td>
            <td>
                <select required='required' name='select_5'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>
            <td rowspan = '2' class="text-area-class">
                <textarea rows='4' placeholder='Indicare la % di popolazione aziendale femminile e illustrare le azioni intraprese.'
                          name = 'note_5' id ='note_5'></textarea>
            </td>
        </tr>
        <tr>
            <td>
                3.2
            </td>
            <td>
                Valorizzazione del personale oltre le discriminazioni
            </td>
            <td colspan = '2'>
                La Direzione aziendale promuove una maggior presenza di donne,
                garantendo la loro piena ed effettiva partecipazione e pari opportunità
                di leadership a tutti i livelli del processo decisionale nella vita aziendale.
            </td>
            <td>
                <select required='required' name='select_6'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>
        </tr>
        </tbody>
        <tr>
            <td colspan="7" class="header-main">
                <a class="section-toggle" data-toggle="collapse" href="#section4" role="button" aria-expanded="false" aria-controls="section4">
                    Punto 4
                </a>
                | Integrare il principio di parità di trattamento nei processi che
                    regolano tutte le fasi della vita professionale e della valorizzazione
                    delle risorse umane, affinché le decisioni relative ad assunzione, formazione
                    e sviluppo di carriera &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                vengano prese unicamente in base alle competenze, all’esperienza,
                    al potenziale professionale delle persone.
            </td>
        </tr>
        <tbody class="collapse" id="section4">
        <tr>
            <td rowspan = '5'>
                4.1
            </td>
            <td rowspan = '5'>
                Gestione non discriminante dei processi chiave relativi alle risorse umane
            </td>
            <td rowspan = '5'>
                Sono stati rivisitati i processi che hanno particolare
                attinenza con le principali categorie di diversità, secondo
                principi di pari opportunità e valorizzazione delle differenze. In particolare:
            </td>
            <td>
                assunzioni gestite con modalità trasparenti e non discriminatorie
            </td>
            <td>
                <select required='required' name='select_7'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>
            <td rowspan = '5' class="text-area-class">
                <textarea rows='4' placeholder='Se si è scelto `altro`, indicare a quali processi si fa riferimento'
                          name = 'note_6' id ='note_6'></textarea>
            </td>
        </tr>
        <tr>

            <td>
                formazione resa equamente accessibile a tutto il personale
            </td>
            <td>
                <select required='required' name='select_8'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>

        </tr>
        <tr>

            <td>
                azioni positive adottate a favore di gruppi potenzialmente discriminati
            </td>
            <td>
                <select required='required' name='select_9'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>

        </tr>
        <tr>

            <td>
                CdA Inclusivi e rappresentativi
            </td>
            <td>
                <select required='required' name='select_10'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>

        </tr>
        <tr>

            <td>
                altro (specificare in Note)
            </td>
            <td>
                <select required='required' name='select_11'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>

        </tr>
        <tr>

            <td rowspan = '4'>
                4.2
            </td>
            <td rowspan = '4'>
                Valutazione non discriminante delle prestazioni per sviluppo carriere e remunerazioni
            </td>
            <td rowspan = '4'>
                L'organizzazione adotta modalità di valutazione che prevengono
                e superano gli stereotipi (relativi a genere, età, etnia, fede religiosa,
                orientamento sessuale) ed ogni possibile forma di penalizzazione garantendo a
                tutti pari opportunità. In particolare, sono adottate modalità che rendano la
                valutazione trasparente e non penalizzante verso categorie a rischio:
            </td>
            <td>
                promozione di processi di selezione e sviluppo trasparenti ed inclusivi
            </td>
            <td>
                <select required='required' name='select_12'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>
            <td rowspan = '4' class="text-area-class">
                <textarea rows='4' placeholder='Se si è scelto `altro`, indicare a quali modalità si fa riferimento' name = 'note_7' id ='note_7'></textarea>
            </td>
        </tr>
        <tr>

            <td>
                analisi dei livelli i retribuitivi per la stessa posizione e azioni correttive
            </td>
            <td>
                <select required='required' name='select_13'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>

        </tr>
        <tr>

            <td>
                possibilità di ricorso contro valutazioni ritenute discriminanti
            </td>
            <td>
                <select required='required' name='select_14'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>

        </tr>
        <tr>

            <td>
                altro (specificare in Note)
            </td>
            <td>
                <select required='required' name='select_15'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>

        </tr>
        </tbody>
        <tr>
            <td colspan="7" class="header-main">
                <a class="section-toggle" data-toggle="collapse" href="#section5" role="button" aria-expanded="false" aria-controls="section5">
                    Punto 5
                </a>
                | Sensibilizzare e formare adeguatamente tutti i livelli dell’organizzazione
                    sul valore della diversità e sulle modalità di gestione delle stesse
            </td>
        </tr>
        <tbody class="collapse" id="section5">
        <tr>
            <td rowspan = '4'>
                5.1
            </td>
            <td rowspan = '4'>
                Sensibilizzazione e formazione del personale a tutti i livelli
            </td>
            <td rowspan = '4'>
                L'organizzazione riconosce la sensibilizzazione e la formazione
                come presupposti essenziali per il successo delle politiche di D&I.
                Tutto il personale è sensibilizzato in tema di pari opportunità e valore
                delle diversità con adeguati interventi e strumenti, diversificati e calibrati
                in base a ruolo e responsabilità. In particolare l’azienda:
            </td>
            <td>
                ha avviato alcune iniziative, ma senza legarle tra di loro e includerle in un disegno organico
            </td>
            <td>
                <select required='required' name='select_16'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>
            <td rowspan = '4' class="text-area-class">
                <textarea rows='4' placeholder='Se si è scelto `altro`, indicare a quali interventi si fa riferimento' name = 'note_8' id ='note_8'></textarea>
            </td>
        </tr>
        <tr>

            <td>
                ha puntato inizialmente su funzioni direzionali e responsabili delle pratiche di gestione risorse umane
            </td>
            <td>
                <select required='required' name='select_17'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>

        </tr>
        <tr>

            <td>
                ha iniziato un piano sistematico che a cascata investa tutti i livelli
            </td>
            <td>
                <select required='required' name='select_18'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>

        </tr>
        <tr>

            <td>
                altro (specificare in Note)
            </td>
            <td>
                <select required='required' name='select_19'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>

        </tr>
        <tr>

            <td rowspan = '6'>
                5.2
            </td>
            <td rowspan = '6'>
                Strumenti adottati e principali temi affrontati
            </td>
            <td rowspan = '6'>
                L’azienda ha avviato i seguenti programmi:
            </td>
            <td>
                a) partecipazione a formazione esterna, seminari, corsi <br>
                c) moduli di e-learning
            </td>
            <td>
                <select required='required' name='select_20'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>
            <td rowspan = '6' class="text-area-class">
                <textarea rows='4' placeholder='Se si è scelto `altro`, indicare a quali programmi si fa riferimento' name = 'note_9' id ='note_9'></textarea>
            </td>
        </tr>
        <tr>

            <td>
                b) partecipazione a incontri esterni di sensibilizzazione, scambi di esperienze <br>
                d) organizzazione per tutto il personale di eventi di sensibilizzazione
            </td>
            <td>
                <select required='required' name='select_21'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>

        </tr>
        <tr>

            <td>
                e) gruppi di lavoro tematici, laboratori formativi per manager
            </td>
            <td>
                <select required='required' name='select_22'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>

        </tr>
        <tr>

            <td>
                f) introduzione di temi generali come rischi legali, vantaggi e sfide della D&I
            </td>
            <td>
                <select required='required' name='select_23'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>

        </tr>
        <tr>

            <td>
                g) approfondimenti su come gestire praticamente problematiche e situazioni
                legate ai temi D&I <br>
                h) aspetti specifici di discriminazione relativi a:
                disabilità, genere, età, origine etnica, orientamento sessuale
            </td>
            <td>
                <select required='required' name='select_24'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>

        </tr>

        <tr>

            <td>
                i) altro (specificare in Note)
            </td>
            <td>
                <select required='required' name='select_25'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>

        </tr>
        </tbody>
        <tr>
            <td colspan="7" class="header-main">
                <a class="section-toggle" data-toggle="collapse" href="#section6" role="button" aria-expanded="false" aria-controls="section6">
                    Punto 6
                </a>
                | Monitorare periodicamente l’andamento delle pari opportunità e valutarne l’impatto delle buone pratiche.
            </td>
        </tr>
        <tbody class="collapse" id="section6">
        <tr>
            <td>
                6.1
            </td>
            <td>
                Definizione di metriche ed indicatori per il monitoraggio dei progressi
            </td>
            <td colspan = '2'>
                L'organizzazione ha sviluppato dei sistemi di monitoraggio dei risultati
                per misurare il livello di raggiungimento dei target Diversity&Inclusion.
            </td>
            <td>
                <select required='required' name='select_26'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>
            <td rowspan = '5' class="text-area-class">
                <textarea rows='4' placeholder='Commento libero non obbligatorio' name = 'note_10' id ='note_10'></textarea>
            </td>
        </tr>
        <tr>

            <td>
                6.2
            </td>
            <td>
                Raccolta dati disaggregati quantitativi
            </td>
            <td colspan = '2'>
                Vengono raccolti, analizzati e comparati i dati disaggregati
                dei principali indicatori (inquadramento contrattuale, assunzioni,
                formazione, sviluppo carriere, flessibilità del lavoro, assenteismo…) per
                identificare eventuali discrepanze in termini di parità di trattamento.
            </td>
            <td>
                <select required='required' name='select_27'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>

        </tr>
        <tr>

            <td>
                6.3
            </td>
            <td>
                Raccolta dati disaggregati qualitativi
            </td>
            <td colspan = '2'>
                Vengono rilevati e analizzati i principali risultati qualitativi delle
                azioni attuate in termini di clima, esperienze, buone pratiche.
            </td>
            <td>
                <select required='required' name='select_28'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>

        </tr>
        <tr>

            <td rowspan = '2'>
                6.4
            </td>
            <td rowspan = '2'>
                Revisione dei risultati e impatti degli interventi e relative decisioni
            </td>
            <td colspan = '2'>
                Viene definito un piano di azione e monitorato lo stato di avanzamento, pianificando gli eventuali interventi correttivi.
            </td>
            <td>
                <select required='required' name='select_29'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>

        </tr>
        <tr>

            <td colspan = '2'>
                Vengono valutati i risultati e gli impatti prodotti (anche dal punto di vista economico).
            </td>
            <td>
                <select required='required' name='select_30'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>

        </tr>
        </tbody>
        <tr>
            <td colspan="7" class="header-main">
                <a class="section-toggle" data-toggle="collapse" href="#section7" role="button" aria-expanded="false" aria-controls="section7">
                    Punto 7
                </a>
                | Individuare e fornire al personale strumenti interni a garanzia della effettiva tutela della parità di trattamento
            </td>
        </tr>
        <tbody class="collapse" id="section7">
        <tr>
            <td>
                7.1
            </td>
            <td>
                Attenzione e ascolto
            </td>
            <td colspan = '2'>
                L'organizzazione attiva strumenti di ascolto di tutte le parti interessate.
            </td>
            <td>
                <select required='required' name='select_31'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>
            <td rowspan = '2' class="text-area-class">
                <textarea rows='4' placeholder='Commento libero non obbligatorio' name = 'note_11' id ='note_11'></textarea>
            </td>
        </tr>
        <tr>

            <td>
                7.2
            </td>
            <td>
                Sistema formalizzato raccolta denunce
            </td>
            <td colspan = '2'>
                L’organizzazione ha un sistema formalizzato, adeguatamente promosso
                tra i dipendenti e di facile accesso, per la raccolta delle denunce
                per discriminazioni, di qualsiasi tipo e gravità, legate al genere,
                all’età, all’etnia, alla fede religiosa o all’orientamento sessuale.
            </td>
            <td>
                <select required='required' name='select_32'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>

        </tr>
        </tbody>
        <tr>
            <td colspan="7" class="header-main">
                <a class="section-toggle" data-toggle="collapse" href="#section8" role="button" aria-expanded="false" aria-controls="section8">
                    Punto 8
                </a>
                    | Fornire strumenti concreti per favorire la conciliazione dei tempi
                    di vita e di lavoro favorendo l’incontro tra domanda e offerta di flessibilità
                    aziendale e delle persone, anche con adeguate politiche aziendali e contrattuali,
                    in &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                collaborazione con il territorio e la convenzione con i servizi pubblici e privati
                    integrati; assicurando una formazione adeguata al rientro dei congedi parentali
            </td>
        </tr>
        <tbody class="collapse" id="section8">
        <tr>
            <td rowspan = '7'>
                8.1
            </td>
            <td rowspan = '7'>
                Flessibilità del lavoro
            </td>
            <td colspan = '2'>
                L’azienda ha attuato iniziative per la soddisfazione dei bisogni in termini di flessibilità del lavoro dei propri dipendenti.
                In particolare attraverso: <br>
                a) accordi contrattuali diretti con lavoratrici/lavoratori <br>
                b) accordi di natura sindacale e collettiva <br>
            </td>
            <td>
                <select required='required' name='select_33'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>
            <td class="text-area-class">
                <textarea rows='4' placeholder='Specificare a quale delle opzioni indicate si fa riferimento.' name = 'note_12' id ='note_12'></textarea>
            </td>
        </tr>
        <tr>

            <td rowspan = '6'>
                con quale delle seguenti forme?
            </td>
            <td>
                a) contratti a tempo parziale
            </td>
            <td>
                <select required='required' name='select_34'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>
            <td rowspan = '6' class="text-area-class">
                <textarea rows='4' placeholder='Se si è scelto `altro`, indicare a quali programmi si fa riferimento'
                          name = 'note_13' id ='note_13'></textarea>
            </td>
        </tr>
        <tr>

            <td>
                b) flessibilità degli orari di lavoro
            </td>
            <td>
                <select required='required' name='select_35'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>

        </tr>
        <tr>

            <td>
                c) telelavoro, smart working e lavoro agile
            </td>
            <td>
                <select required='required' name='select_36'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>

        </tr>
        <tr>

            <td>
                d) banca delle ore
            </td>
            <td>
                <select required='required' name='select_37'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>

        </tr>
        <tr>

            <td>
                e) accordi territoriali per servizi alla persona
            </td>
            <td>
                <select required='required' name='select_38'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>

        </tr>
        <tr>

            <td>
                f) altro (specificare)
            </td>
            <td>
                <select required='required' name='select_39'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>

        </tr>
        <tr>

            <td rowspan = '9'>
                8.2
            </td>
            <td rowspan = '9'>
                Supporti per la conciliazione della vita privata - vita lavorativa
            </td>
            <td rowspan = '9'>
                L’azienda individua uno o più supporti alla conciliazione organizzati
                anche in collaborazione con istituzioni, terzo settore, altre imprese, nelle seguenti forme:
            </td>
            <td>
                a) servizi / sportelli di ascolto e consulenza
            </td>
            <td>
                <select required='required' name='select_40'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>
            <td rowspan = '9' class="text-area-class">
                <textarea rows='4' placeholder='Se si è scelto `altro`, indicare a quali programmi si fa riferimento' name = 'note_14' id ='note_14'></textarea>
            </td>
        </tr>
        <tr>

            <td>
                b) asili nido aziendali
            </td>
            <td>
                <select required='required' name='select_41'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>

        </tr>
        <tr>

            <td>
                c) convenzioni per servizi di assistenza/welfare
            </td>
            <td>
                <select required='required' name='select_42'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>

        </tr>
        <tr>

            <td>
                d) maggiordomo aziendale: disbrigo pratiche, servizi lavanderia/spesa
            </td>
            <td>
                <select required='required' name='select_43'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>

        </tr>
        <tr>

            <td>
                e) contributi alle spese di cura, benefit aziendali
            </td>
            <td>
                <select required='required' name='select_44'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>

        </tr>
        <tr>

            <td>
                f) servizi di trasporto
            </td>
            <td>
                <select required='required' name='select_45'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>

        </tr>
        <tr>

            <td>
                g) accordi con altre imprese per dividere i costi dei servizi
            </td>
            <td>
                <select required='required' name='select_46'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>

        </tr>
        <tr>

            <td>
                h) reti territoriali di conciliazione con istituzione e altre imprese
            </td>
            <td>
                <select required='required' name='select_47'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>

        </tr>
        <tr>

            <td>
                i) altro (specificare)
            </td>
            <td>
                <select required='required' name='select_48'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>

        </tr>
        <tr>

            <td rowspan = '5'>
                8.3
            </td>
            <td rowspan = '5'>
                La gestione dei lunghi congedi
            </td>
            <td rowspan = '5'>
                La gestione dei lunghi congedi richiede una pianificazione strutturata prima, durante e dopo.
                Quali sono stati i piani attivati dall’azienda in merito?
            </td>
            <td>
                a) pre-congedo, stesura piano di congedo e carriera post rientro
            </td>
            <td>
                <select required='required' name='select_49'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>
            <td rowspan = '5' class="text-area-class">
                <textarea rows='4' placeholder='Se si è scelto `altro`, indicare a quali programmi si fa riferimento' name = 'note_15' id ='note_15'></textarea>
            </td>
        </tr>
        <tr>

            <td>
                b) supporto e aggiornamento per mantenere i contatti e facilitare il rientro
            </td>
            <td>
                <select required='required' name='select_50'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>

        </tr>
        <tr>

            <td>
                c) formazione specifica per reinserimento dopo congedo di maternità
            </td>
            <td>
                <select required='required' name='select_51'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>

        </tr>
        <tr>

            <td>
                d) formazione capi diretti per la relazione e il reinserimento dopo congedo
            </td>
            <td>
                <select required='required' name='select_52'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>

        </tr>
        <tr>

            <td>
                e) altro (specificare)
            </td>
            <td>
                <select required='required' name='select_53'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>

        </tr>
        </tbody>
        <tr>
            <td colspan="7" class="header-main">
                <a class="section-toggle" data-toggle="collapse" href="#section9" role="button" aria-expanded="false" aria-controls="section9">
                    Punto 9
                </a>
                    | Comunicare al personale, con le modalità più opportune, l’impegno
                    assunto a favore di una cultura aziendale della pari opportunità,
                    informandolo sui progetti intrapresi in tali ambiti e sui risultati pratici conseguiti.
            </td>
        </tr>
        <tbody class="collapse" id="section9">
        <tr>
            <td rowspan = '2'>
                9.1
            </td>
            <td rowspan = '2'>
                La comunicazione interna
            </td>
            <td colspan = '2'>
                Gli strumenti adottati dall'organizzazione per comunicare a tutto il personale
                il proprio impegno per la tutela e la promozione delle pari opportunità e la valorizzazione delle
                diversità in azienda, gli interventi/progetti realizzati ed i risultati ottenuti sono in particolare (specificare nelle note): <br>
                a) lettere, disposizioni generali, circolari di direzione <br>
                b) intranet <br>
                c) stampa/newseltter aziendale <br>
                d) affissioni in bacheca <br>
                e) documentazione per nuovi assunti <br>
                f) altro (specificare) <br>
            </td>
            <td>
                <select required='required' name='select_54'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>
            <td class="text-area-class">
                <textarea rows='4' placeholder='Specificare quali delle opzioni indicate sono state implementate, se si è scelto `altro`, indicare esplicitamente a quale strumento si fa riferimento' name = 'note_16' id ='note_16'></textarea>
            </td>
        </tr>
        <tr>

            <td colspan = '2'>
                In particolare viene comunicato: <br>
                a) impegno della direzione <br>
                b) interventi/progetti realizzati e risultati ottenuti <br>
                c) nuovi servizi offerti <br>
                d) altro (specificare) <br>
            </td>
            <td>
                <select required='required' name='select_55'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>
            <td class="text-area-class">
                <textarea rows='4' placeholder='Specificare quali delle opzioni indicate sono state implementate,se si è scelto `altro`, indicare esplicitamente cosa viene comunicato' name = 'note_17' id ='note_17'></textarea>
            </td>
        </tr>
        </tbody>
        <tr>
            <td colspan="7" class="header-main">
                <a class="section-toggle" data-toggle="collapse" href="#section10" role="button" aria-expanded="false" aria-controls="section10">
                    Punto 10
                </a>
                | Promuovere la visibilità esterna dell’impegno aziendale, dando
                    testimonianza delle politiche adottate e dei progressi ottenuti in un’ottica
                    di comunità realmente solidale e responsabile.
            </td>
        </tr>
        <tbody class="collapse" id="section10">
        <tr>
            <td>
                10.1
            </td>
            <td>
                Comunicazione esterna
            </td>
            <td colspan = '2'>
                L’organizzazione comunica all’esterno le sue politiche e
                gli interventi in tema di Diversity&Inclusion, a tutti i suoi stakeholder ,
                in particolare ai referenti istituzionali, ai fornitori, ai clienti, agli
                azionisti attraverso: <br>
                a) sito internet e sue sezioni dedicate <br>
                b) partecipazione/organizzazione di convegni <br>
                c) partecipazione a premi/award <br>
                d) condivisione pratiche attraverso reti specializzate <br>
                e) altro (specificare in Note) <br>
            </td>
            <td>
                <select required='required' name='select_56'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>
            <td class="text-area-class">
                <textarea rows='4' placeholder='Specificare quali delle opzioni indicate sono state implementate, se si è scelto `altro`, indicare esplicitamente a quale strumento si fa riferimento' name = 'note_18' id ='note_18'></textarea>
            </td>
        </tr>
        <tr>

            <td>
                10.2
            </td>
            <td>
                Rapporti con le istituzioni e il territorio
            </td>
            <td colspan = '2'>
                La Direzione e i responsabili instaurano rapporti stabili con referenti istituzionali e non per concordare: <br>
                a) la realizzazione congiunta con altre imprese locali di un nuovo servizio <br>
                b) accordi territoriali per costituire reti di servizi <br>
                c) interventi a favore di una migliore qualità di vita e di lavoro (housing, trasporti…) <br>
                d) altro (specificare) <br>
            </td>
            <td>
                <select required='required' name='select_57'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>
            <td class="text-area-class">
                <textarea rows='4' placeholder='Specificare quali delle opzioni indicate sono state implementate,se si è scelto `altro`, indicare esplicitamente a cosa si fa riferimento' name = 'note_19' id ='note_19'></textarea>
            </td>
        </tr>
        </tbody>
        <tr>
            <td colspan = '7'></td>
        </tr>
        <tr>
            <td colspan="7">
                <a class="section-toggle" data-toggle="collapse" href="#section11" role="button" aria-expanded="false" aria-controls="section11">
                    Sezione Target Diversity & Inclusion
                </a>
            </td>
        </tr>
        <tbody class="collapse" id="section11">
        <tr>
            <td rowspan = '8' colspan = '2'>
                Nello specifico le iniziative che avete avviato o che state
                inviando nella vostra organizzazione verso quale ambito di Diversity
                & Inclusion si sono indirizzate (possibilità di risposta multipla)?
            </td>
            <td colspan = '2'>
                Donne
            </td>
            <td>
                <select required='required' name='select_58'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>
            <td rowspan = '8' class="text-area-class">
                <textarea rows='4' placeholder='Commento libero non obbligatorio' name = 'note_20' id ='comments'></textarea>
            </td>
        </tr>
        <tr>
            <td colspan = '2'>
                Giovani
            </td>
            <td>
                <select required='required' name='select_59'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>

        </tr>
        <tr>
            <td colspan = '2'>
                Senior
            </td>
            <td>
                <select required='required' name='select_60'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>

        </tr>
        <tr>
            <td colspan = '2'>
                Disabili
            </td>
            <td>
                <select required='required' name='select_61'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>

        </tr>
        <tr>
            <td colspan = '2'>
                Minoranze etniche
            </td>
            <td>
                <select required='required' name='select_62'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>

        </tr>
        <tr>
            <td colspan = '2'>
                Minoranze religiose
            </td>
            <td>
                <select required='required' name='select_63'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>

        </tr>
        <tr>
            <td colspan = '2'>
                LGBT
            </td>
            <td>
                <select required='required' name='select_64'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>

        </tr>
        <tr>
            <td colspan = '2'>
                Altro (specificare in NOte)
            </td>
            <td>
                <select required='required' name='select_65'>
                    <option value='SI'>SI</option>
                    <option value='NO'>NO</option>
                </select>
            </td>

        </tr>
        </tbody>
        </tbody>
    </table>
    <input type = 'hidden' name = 'action' value = 'form_render_save'>
    <button class="btn btn-info form-submit-button" type='submit' name = 'submit'>Invia</button>
</form>

<script type="text/javascript">
    jQuery(function(){
        jQuery(".section-toggle").on("click", function() {
            if(jQuery(this).attr("aria-expanded") == "false"){
                jQuery(".table-header").removeClass("d-none");
                return;
            }
            let els = jQuery("td>a.section-toggle");
            let trueCount = 0;
            for(let i=0;i<els.length;i++){
                if(jQuery(els[i]).attr("aria-expanded") == "true"){
                    trueCount = trueCount+1;
                }
            }
            if(trueCount <= 1){
                jQuery(".table-header").addClass("d-none");
            }
        });
        jQuery("select[name=sector]").change(function(){
           let value = jQuery(this).val();
           if(value === "Altro (specificare)"){
               jQuery("#sector-td").append(
                   jQuery("<input type='text' placeholder='SETTORE' name='sector' id='sector-input' required='required'/>")
               )
           }else{
                let sectorInput = jQuery("#sector-input");
                if(sectorInput){
                    sectorInput.remove();
                }
           }
        });
        const now = new Date();
        let day = ("0" + now.getDate()).slice(-2);
        const month = ("0" + (now.getMonth() + 1)).slice(-2);
        const today = now.getFullYear() + "-" + (month) + "-" + (day);
        jQuery("input[name=issued_date").val(today);
    })
</script>