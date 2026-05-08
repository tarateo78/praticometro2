    /**
     * FUNZIONE DI ORDINAMENTO ALFABETICO DELLE TABELLE
     * Aggiungendo la classe "tm-sortable" ad una tabella permette
     * di mettere in ordine alfabetico tutte le colonne.
     * Usare la classe "tm-num" al <th> per le colonne numeriche
     */
    const table = document.getElementsByClassName("tm-sortable")[0];

    if(typeof table !== 'undefined') {
        const rows = table.rows;
        let n_rows = rows.length;
        const nodiTabella = table.childNodes;
        
        nodiTabella.forEach(element => {
            if(element.nodeName === "THEAD" || element.nodeName === "TFOOT")
            n_rows--;
        });

        const th = table.getElementsByTagName("th");

        for(let i = 0; i < th.length; i++)
            {
                th[i].addEventListener('click', element => {
                    
                let switching = true;
                let shouldSwitch = null;
                let j = null;

                if(element.target.classList.contains("tm-asc")) {

                    while (switching) {
                        switching = false;
                        for (j = 1; j <= n_rows -1 ; j++) {
                            shouldSwitch = false;
                            let x = rows[j].getElementsByTagName("TD")[element.target.cellIndex];
                            let y = rows[j + 1].getElementsByTagName("TD")[element.target.cellIndex];

                            if (!element.target.classList.contains("tm-num") && x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                                shouldSwitch = true;
                                break;
                            }else if (element.target.classList.contains("tm-num")){
                                if(Number(x.innerHTML.replace(" €","").replace(".","").replace(",",".")) < Number(y.innerHTML.replace(" €","").replace(".","").replace(",","."))) {
                                    shouldSwitch = true;
                                    break;
                                }
                            }
                        }
                        if (shouldSwitch) {
                            rows[j].parentNode.insertBefore(rows[j + 1], rows[j]);
                            switching = true;
                        }
                    }
                    
                    element.target.classList.remove("tm-asc");
                    
                } else {
                    
                    // Ordine crescente
                    while (switching) {
                        switching = false;
                        for (j = 1; j <= n_rows ; j++) {
                            shouldSwitch = false;
                            let x = rows[j].getElementsByTagName("TD")[element.target.cellIndex];
                            let y = rows[j + 1].getElementsByTagName("TD")[element.target.cellIndex];
                            

                            if ( x.innerText > y.innerText) {
                                shouldSwitch = true;
                                break;
                            }
                            // else if (element.target.classList.contains("tm-num")){
                            //     if(Number(x.innerHTML.replace(" €","").replace(".","").replace(",",".")) > Number(y.innerHTML.replace(" €","").replace(".","").replace(",","."))) {
                            //         shouldSwitch = true;
                            //         break;
                            //     }
                            // }
                        }
                        if (shouldSwitch) {
                            rows[j].parentNode.insertBefore(rows[j + 1], rows[j]);
                            switching = true;
                        }
                    }

                    element.target.classList.add("tm-asc");
                }
            });
        }
    }