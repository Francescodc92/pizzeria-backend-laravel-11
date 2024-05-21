## Backend Progetto finale 2.0 
- [repo versione laravel 10](https://github.com/Francescodc92/pizzeria-backend)
- [repo frontend (temporaneo)](https://github.com/Francescodc92/pizzeria-full-stack)

### Progetto db
![database-structure](./.github/db_pizzeria.png)

## TODO
  ### Admin 

  1. sistemare il componente di paginazione default di laravel
  2. sistemare l'update dell'order (da fare)

  3. filtrare gli ordini già completi perché non vengano  visualizzati
    - premetter il riordinamento in base ai campi cliccati nella table 
    - permettere la visualizzazione degli ordini terminati
    
  4. iniziare a lavorare sulla parte della dashboard (grafici per amministratore)
    x numero acquisti nell'ultima settimana/mese/anno (grafico 1)
    x numero acquisti negli ultimi 5 anni (per avere un resoconto dell'andamento nel tempo)(grafico 2)
    x entrate nell'ultima settima/mese/anno (grafico 3)
    x entrate negli ultimi 5 anni (per avere un resoconto dell'andamento nel tempo) (grafico 4)
    - (da pensare ) un grafico per il numero di utenti registrati se necessario

  ### Employee
  1. creare un layout per i dipendenti con un componente navigation specifico in modo da mostrare le rotte specifiche 
    - eliminare dalle rotte tutto quello che riguarda gli admin (creare delle visualizzazioni condizionali per le pagine esistenti o crearne di specifiche (meglio la prima opzione ))
  
  ### User (api)
  1. sistemare il frontend perche funzioni con il nuovo backend (temporaneamente)
      - adattare le rotte api del progetto con laravel10 alle nuove rotte laravel11 (cambiare i campi modificati nel nuovo progetto)
      - creare la rotta per la visualizzazione degli ordini dell'utente
      - creare le rotte per le pizze
        - implementare il ritorno delle sole pizza disponibili 


  ### future aggiunte
  1. aggiungere una tabella ingredienti per dare opzione di cambiare ingrediente specifico 

### Tecnologie:
  - laravel 11
    - Breeze
    - sanctum
    - spatie (gestione dei ruoli)
  - docker
  - tailwind css
  - mySql 