<?php

require_once(ABSPATH . 'wp-config.php');
function surveyForm(){
    $states = array("AG","AL","AN","AO","AQ","AR","AP","AT","AV","BA","BT","BL","BN","BG","BI","BO","BZ","BS","BR","CA",
        "CL","CB","CI","CE","CT","CZ","CH","CO","CS","CR","KR","CN","EN","FM","FE","FI","FG","FC","FR","GE","GO","GR",
        "IM","IS","SP","LT","LE","LC","LI","LO","LU","MC","MN","MS","MT","VS","ME","MI","MO","MB","NA","NO","NU","OG","OT",
        "OR","PD","PA","PR","PV","PG","PU","PE","PC","PI","PT","PN","PZ","PO","RG","RA","RC","RE","RI","RN","Roma","RO",
        "SA","SS","SV","SI","SR","SO","TA","TE","TR","TO","TP","TN","TV","TS","UD","VA","VE","VB","VC","VR","VV","VI","VT");
        echo "<style>
            table{
                font-size: 12px !important;
            }
            .form-design{
                max-width: 98% !important;
                width: 98% !important;
                font-size: 12px !important;
            }
            #table-2 {
                border-collapse: collapse !important;
                padding: 15px !important;
                margin: 30px 10px 10px !important;
            }
            #table-1{
                width: 50% !important;
                padding: 25PX !important;
            }
            #table-1 th{
                border: 0px !important;
            }
            #table-1 td{
                padding-right: 20px !important;
            }
            #table-2 td {
                border: 1px solid #333 !important;
                padding: 5px !important;
                font-size: 12px;
                width: 10% !important;
            }
            #table-1 th{
                float: left !important;
            }
            #table-1 select, #table-1 input[type='text'], #table-1 input[type='date'], #table-1 textarea{
              width:100% !important;
              box-sizing:border-box !important;
              margin-left: 20px !important;
              margin-top: 5px !important;
            }
            caption{
                padding: 20px !important;
                font-size: 20px !important;
            }
            #table-1 textarea::placeholder {
                  color: #444 !important;
                  text-align: center !important;
                  overflow: hidden !important;
            }
            
        
        </style>";
        echo "<form action = '".plugins_url( '/form_render_submit.php', __FILE__ )."' method = 'post' id = 'form_render_id' class = 'form-design'>";
        echo "<table id='table-1'>";
        echo "<caption>COMPANY DATA</caption></hr>";
        echo "<tbody>";
        echo "<tr>
                <th>COMPANY NAME</th>
                <td><textarea name='company_name' required='required'></textarea></td>
            </tr>";
        echo "<tr>
                <th>COMPANY DATA</th>
                <td>
                <select name='company_data' required='required'>
                    <option value='1'>IMPRESA-ASSOCIAZIONE IMPRENDITORIALE</option>
                    <option value='2'>ENTE PUBBLICO</option>
                    <option value='3'>TERZO SETTORE E SOCIETA' CIVILE</option>
                </select>
                </td>
            </tr>";
        echo "<tr>
                <th>SECTOR</th>
                <td><textarea name='sector' required='required'></textarea></td>
            </tr>";
        echo "<tr>
                <th>NUMBER OF EMPLOYEES</th>
                <td>
                <select name='no_of_employee' required='required'>
                    <option value='1'>0-10</option>
                    <option value='2'>11-50</option>
                    <option value='3'>51-250</option>
                    <option value='4'>251-1000</option>
                    <option value='5'>1001-5000</option>
                    <option value='6'>Oltre 5000</option>
                </select>
                </td>
            </tr>";
        echo "<tr>
                <th>STATE</th>
                <td>
                <select name='state' required='required'>";
        foreach ($states as $state){
            echo "<option value='$state'>$state</option>";
        }
        echo "</select>
                </td>
            </tr>";
        echo "<tr>
                <th>PERSON WHO IS FILLING THE QUESTIONAIRE</th>
                <td><input type='text' name='author' placeholder='Person Who Is Filling The Questionaire' required='required'/></td>
            </tr>";
        echo "<tr>
                <th>DATE OF ISSUE</th>
                <td><input type='date' name='issued_date' placeholder='Date of Issue' required='required'/></td>
            </tr>";
    
        echo "</tbody>";
        echo "</table>";

        echo "<table id = 'table-2'>";
        echo "<thead><th>AZIONE</th><th>RIFERIMENTO</th><th>REQUISITO</th><th>CRITERIO</th><th></th><th>ANSWER</th><th>Note</th></thead>";
        echo "<tbody>";
        echo "<tr>";
            echo "<td rowspan = '2'>
                Definire e attuare politiche aziendali che, a partire dal vertice, coinvolgano tutti i 
                livelli dell’organizzazione nel rispetto del principio della pari dignità e trattamento sul lavoro
            </td>
            <td>
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
                <select name='select_1'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_1' id='note_1'></textarea>
            </td>";      
        echo "</tr>";
        echo "<tr>";
            echo "<td>
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
                <select name='select_2'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_2' id='note_2'></textarea>
            </td>";
        echo "</tr>";
        echo "<tr>";
            echo "<td rowspan = '2'>
                Individuare funzioni aziendali alle quali attribuire chiare 
                responsabilità in materia di pari opportunità
            </td>
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
                <select name='select_3'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_3' id ='note_3'></textarea>
            </td>";      
        echo "</tr>";
        echo "<tr>";
            echo "<td>
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
                <select name='select_4'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_4' id ='note_4'></textarea>
            </td>";
        echo "</tr>";
        echo "<tr>";
            echo "<td rowspan = '2'>
                Superare gli stereotipi di genere, attraverso adeguate politiche aziendali, 
                formazione e sensibilizzazione, anche promuovendo i percorsi di carriera
            </td>
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
                <select name='select_5'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_5' id ='note_5'></textarea>
            </td>";      
        echo "</tr>";
        echo "<tr>";
            echo "<td>
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
                <select name='select_6'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_6' id ='note_6'></textarea>
            </td>";
        echo "</tr>";
        echo "<tr>";
            echo "<td rowspan = '9'>
                Integrare il principio di parità di trattamento nei processi che 
                regolano tutte le fasi della vita professionale e della valorizzazione 
                delle risorse umane, affinché le decisioni relative ad assunzione, formazione 
                e sviluppo di carriera vengano prese unicamente in base alle competenze, all’esperienza, 
                al potenziale professionale delle persone.
            </td>
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
                <select name='select_7'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_7' id ='note_7'></textarea>
            </td>";      
        echo "</tr>";
        echo "<tr>";
            echo "
            <td>
                formazione resa equamente accessibile a tutto il personale
            </td>
            <td>
                <select name='select_8'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_8' id ='note_8'></textarea>
            </td>";
        echo "</tr>";
        echo "<tr>";
            echo "
            <td>
                azioni positive adottate a favore di gruppi potenzialmente discriminati
            </td>
            <td>
                <select name='select_9'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_9' id ='note_9'></textarea>
            </td>";
        echo "</tr>";
        echo "<tr>";
            echo "
            <td>
                CdA Inclusivi e rappresentativi
            </td>
            <td>
                <select name='select_10'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_10' id ='note_10'></textarea>
            </td>";
        echo "</tr>";
        echo "<tr>";
            echo "
            <td>
                altro (specificare in Note)
            </td>
            <td>
                <select name='select_11'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_11' id ='note_11'></textarea>
            </td>";
        echo "</tr>";
        echo "<tr>";
            echo "
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
                <select name='select_12'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_12' id ='note_12'></textarea>
            </td>";      
        echo "</tr>";
        echo "<tr>";
            echo "
            <td>
                analisi dei livelli i retribuitivi per la stessa posizione e azioni correttive
            </td>
            <td>
                <select name='select_13'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_13' id ='note_13'></textarea>
            </td>";
        echo "</tr>";
        echo "<tr>";
            echo "
            <td>
                possibilità di ricorso contro valutazioni ritenute discriminanti
            </td>
            <td>
                <select name='select_14'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_14' id ='note_14'></textarea>
            </td>";
        echo "</tr>";
        echo "<tr>";
            echo "
            <td>
                altro (specificare in Note)
            </td>
            <td>
                <select name='select_15'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_15' id ='note_15'></textarea>
            </td>";
        echo "</tr>";
        echo "<tr>";
            echo "<td rowspan = '10'>
                Sensibilizzare e formare adeguatamente tutti i livelli dell’organizzazione 
                sul valore della diversità e sulle modalità di gestione delle stesse
            </td>
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
                <select name='select_16'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_16' id ='note_16'></textarea>
            </td>";      
        echo "</tr>";
        echo "<tr>";
            echo "
            <td>
                ha puntato inizialmente su funzioni direzionali e responsabili delle pratiche di gestione risorse umane
            </td>
            <td>
                <select name='select_17'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_17' id ='note_17'></textarea>
            </td>";
        echo "</tr>";
        echo "<tr>";
            echo "
            <td>
                ha iniziato un piano sistematico che a cascata investa tutti i livelli
            </td>
            <td>
                <select name='select_18'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_18' id ='note_18'></textarea>
            </td>";
        echo "</tr>";
        echo "<tr>";
            echo "
            <td>
                altro (specificare in Note)
            </td>
            <td>
                <select name='select_19'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_19' id ='note_19'></textarea>
            </td>";
        echo "</tr>";
        echo "<tr>";
            echo "
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
                partecipazione a formazione esterna, seminari, corsi c) moduli di e-learning
            </td>
            <td>
                <select name='select_20'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_20' id ='note_20'></textarea>
            </td>";      
        echo "</tr>";
        echo "<tr>";
            echo "
            <td>
                partecipazione a incontri esterni di sensibilizzazione, scambi 
                di esperienze d) organizzazione per tutto il personale di eventi di sensibilizzazione
            </td>
            <td>
                <select name='select_21'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_21' id ='note_21'></textarea>
            </td>";
        echo "</tr>";
        echo "<tr>";
            echo "
            <td>
                gruppi di lavoro tematici, laboratori formativi per manager
            </td>
            <td>
                <select name='select_22'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_22' id ='note_22'></textarea>
            </td>";
        echo "</tr>";
        echo "<tr>";
            echo "
            <td>
                approfondimenti su come gestire praticamente problematiche e situazioni 
                legate ai temi D&I h) aspetti specifici di discriminazione relativi a: 
                    disabilità, genere, età, origine etnica, orientamento sessuale
            </td>
            <td>
                <select name='select_23'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_23' id ='note_23'></textarea>
            </td>";
        echo "</tr>";
        echo "<tr>";
            echo "
            <td>
                introduzione di temi generali come rischi legali, vantaggi e sfide della D&I
            </td>
            <td>
                <select name='select_24'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_24' id ='note_24'></textarea>
            </td>";
        echo "</tr>";
        echo "<tr>";
            echo "
            <td>
                altro (specificare in Note)
            </td>
            <td>
                <select name='select_25'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_25' id ='note_25'></textarea>
            </td>";
        echo "</tr>";
        echo "<tr>";
            echo "
            <td rowspan = '5'>
                Monitorare periodicamente l’andamento delle pari opportunità e valutarne l’impatto delle buone pratiche.
            </td>
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
                <select name='select_26'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_26' id ='note_26'></textarea>
            </td>";      
        echo "</tr>";
        echo "<tr>";
            echo "
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
                <select name='select_27'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_27' id ='note_27'></textarea>
            </td>";      
        echo "</tr>";
        echo "<tr>";
            echo "
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
                <select name='select_28'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_28' id ='note_28'></textarea>
            </td>";      
        echo "</tr>";
        echo "<tr>";
            echo "
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
                <select name='select_29'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_29' id ='note_29'></textarea>
            </td>";      
        echo "</tr>";
        echo "<tr>";
            echo "
            <td colspan = '2'>
                Vengono valutati i risultati e gli impatti prodotti (anche dal punto di vista economico).
            </td>
            <td>
                <select name='select_30'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_30' id ='note_30'></textarea>
            </td>";      
        echo "</tr>";
        echo "<tr>";
            echo "
            <td rowspan = '2'>
                Individuare e fornire al personale strumenti interni a garanzia della effettiva tutela della parità di trattamento
            </td>
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
                <select name='select_31'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_31' id ='note_31'></textarea>
            </td>";      
        echo "</tr>";
        echo "<tr>";
            echo "
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
                <select name='select_32'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_32' id ='note_32'></textarea>
            </td>";      
        echo "</tr>";
        echo "<tr>";
            echo "
            <td rowspan = '21'>
                Fornire strumenti concreti per favorire la conciliazione dei tempi 
                di vita e di lavoro favorendo l’incontro tra domanda e offerta di flessibilità 
                aziendale e delle persone, anche con adeguate politiche aziendali e contrattuali, 
                in collaborazione con il territorio e la convenzione con i servizi pubblici e privati 
                integrati; assicurando una formazione adeguata al rientro dei congedi parentali
            </td>
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
                <select name='select_33'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_33' id ='note_33'></textarea>
            </td>";      
        echo "</tr>";
        echo "<tr>";
            echo "
            <td rowspan = '6'>
                con quale delle seguenti forme?
            </td>
            <td>
                a) contratti a tempo parziale 
            </td>
            <td>
                <select name='select_34'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_34' id ='note_34'></textarea>
            </td>";      
        echo "</tr>";
        echo "<tr>";
            echo "
            <td>
                b) flessibilità degli orari di lavoro
            </td>
            <td>
                <select name='select_35'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_36' id ='note_36'></textarea>
            </td>";      
        echo "</tr>";
        echo "<tr>";
            echo "
            <td>
                c) telelavoro, smart working e lavoro agile
            </td>
            <td>
                <select name='select_36'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_36' id ='note_36'></textarea>
            </td>";      
        echo "</tr>";
        echo "<tr>";
            echo "
            <td>
                d) banca delle ore
            </td>
            <td>
                <select name='select_37'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_37' id ='note_37'></textarea>
            </td>";      
        echo "</tr>";
        echo "<tr>";
            echo "
            <td>
                e) accordi territoriali per servizi alla persona
            </td>
            <td>
                <select name='select_38'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_38' id ='note_38'></textarea>
            </td>";      
        echo "</tr>";
        echo "<tr>";
            echo "
            <td>
                f) altro (specificare)
            </td>
            <td>
                <select name='select_39'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_39' id ='note_39'></textarea>
            </td>";      
        echo "</tr>";
        echo "<tr>";
            echo "
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
                <select name='select_40'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_40' id ='note_40'></textarea>
            </td>";      
        echo "</tr>";
        echo "<tr>";
            echo "
            <td>
                b) asili nido aziendali
            </td>
            <td>
                <select name='select_41'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_41' id ='note_41'></textarea>
            </td>";      
        echo "</tr>";
        echo "<tr>";
            echo "
            <td>
                c) convenzioni per servizi di assistenza/welfare
            </td>
            <td>
                <select name='select_42'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_42' id ='note_42'></textarea>
            </td>";      
        echo "</tr>";
        echo "<tr>";
            echo "
            <td>
                d) maggiordomo aziendale: disbrigo pratiche, servizi lavanderia/spesa
            </td>
            <td>
                <select name='select_43'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_43' id ='note_43'></textarea>
            </td>";      
        echo "</tr>";
        echo "<tr>";
            echo "
            <td>
                e) contributi alle spese di cura, benefit aziendali
            </td>
            <td>
                <select name='select_44'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_44' id ='note_44'></textarea>
            </td>";      
        echo "</tr>";
        echo "<tr>";
            echo "
            <td>
                f) servizi di trasporto
            </td>
            <td>
                <select name='select_45'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_45' id ='note_45'></textarea>
            </td>";      
        echo "</tr>";
        echo "<tr>";
            echo "
            <td>
                g) accordi con altre imprese per dividere i costi dei servizi
            </td>
            <td>
                <select name='select_46'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_46' id ='note_46'></textarea>
            </td>";      
        echo "</tr>";
        echo "<tr>";
            echo "
            <td>
                h) reti territoriali di conciliazione con istituzione e altre imprese
            </td>
            <td>
                <select name='select_47'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_47' id ='note_47'></textarea>
            </td>";      
        echo "</tr>";
        echo "<tr>";
            echo "
            <td>
                i) altro (specificare)
            </td>
            <td>
                <select name='select_48'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_48' id ='note_48'></textarea>
            </td>";      
        echo "</tr>";
        echo "<tr>";
            echo "
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
                <select name='select_49'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_49' id ='note_49'></textarea>
            </td>";      
        echo "</tr>";
        echo "<tr>";
            echo "
            <td>
                b) supporto e aggiornamento per mantenere i contatti e facilitare il rientro
            </td>
            <td>
                <select name='select_50'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_50' id ='note_50'></textarea>
            </td>";      
        echo "</tr>";
        echo "<tr>";
            echo "
            <td>
                c) formazione specifica per reinserimento dopo congedo di maternità
            </td>
            <td>
                <select name='select_51'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_51' id ='note_51'></textarea>
            </td>";      
        echo "</tr>";
        echo "<tr>";
            echo "
            <td>
                d) formazione capi diretti per la relazione e il reinserimento dopo congedo
            </td>
            <td>
                <select name='select_52'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_52' id ='note_52'></textarea>
            </td>";      
        echo "</tr>";
        echo "<tr>";
            echo "
            <td>
                e) altro (specificare)
            </td>
            <td>
                <select name='select_53'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_53' id ='note_53'></textarea>
            </td>";      
        echo "</tr>";
        echo "<tr>";
            echo "<td rowspan = '2'>
                Comunicare al personale, con le modalità più opportune, l’impegno 
                assunto a favore di una cultura aziendale della pari opportunità, 
                informandolo sui progetti intrapresi in tali ambiti e sui risultati pratici conseguiti.
            </td>
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
                <select name='select_54'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_54' id ='note_54'></textarea>
            </td>";      
        echo "</tr>";
        echo "<tr>";
            echo "
            <td colspan = '2'>
                In particolare viene comunicato: <br>
                    a) impegno della direzione <br>
                    b) interventi/progetti realizzati e risultati ottenuti <br>
                    c) nuovi servizi offerti <br>
                    d) altro (specificare) <br>
            </td>
            <td>
                <select name='select_55'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                    <textarea rows='4' placeholder='Note' name = 'note_55' id ='note_55'></textarea>
            </td>";
        echo "</tr>";
        echo "<tr>";
            echo "<td rowspan = '2'>
                Promuovere la visibilità esterna dell’impegno aziendale, dando 
                testimonianza delle politiche adottate e dei progressi ottenuti in un’ottica 
                di comunità realmente solidale e responsabile.
            </td>
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
                <select name='select_56'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_56' id ='note_56'></textarea>
            </td>";      
        echo "</tr>";
        echo "<tr>";
            echo "
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
                <select name='select_57'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </td>
            <td>
                <textarea rows='4' placeholder='Note' name = 'note_57' id ='note_57'></textarea>
            </td>";      
        echo "</tr>";
        echo "<tr>";
            echo "<td colspan = '7'></td>";
        echo "</tr>";
        echo "<tr>";
            echo "<td rowspan = '8'>
                Target Diversity&Inclusion
            </td>
            <td rowspan = '8' colspan = '2'>
                Nello specifico le iniziative che avete avviato o che state 
                inviando nella vostra organizzazione verso quale ambito di Diversity 
                & Inclusion si sono indirizzate (possibilità di risposta multipla)?
            </td>
            <td colspan = '2'>
                Donne
            </td>
            <td rowspan = '8' colspan = '2'>
                <textarea rows='4' placeholder='Commento libero non obbligatorio' name = 'comments' id ='comments'></textarea>
            </td>";  
        echo "</tr>";
        echo "<tr>";
            echo "<td colspan = '2'>
                Giovani
            </td>
            ";
        echo "</tr>";
        echo "<tr>";
            echo "<td colspan = '2'>
                Senior
            </td>
            ";
        echo "</tr>";
        echo "<tr>";
            echo "<td colspan = '2'>
                Disabili
            </td>
            ";
        echo "</tr>";
        echo "<tr>";
            echo "<td colspan = '2'>
                Minoranze etniche
            </td>
            ";
        echo "</tr>";
        echo "<tr>";
            echo "<td colspan = '2'>
                Minoranze religiose
            </td>
            ";
        echo "</tr>";
        echo "<tr>";
            echo "<td colspan = '2'>
                LGBT
            </td>
            ";
        echo "</tr>";
        echo "<tr>";
            echo "<td colspan = '2'>
                Altro (specificare in Note)
            </td>
            ";
        echo "</tr>";
        echo "</tbody>";
        echo "</table>";
        echo "<button type='submit' name = 'submit'>Submit</button>";
        echo "</form>";
}
add_shortcode("survey_form", "surveyForm");
?>