## Backend Progetto finale 2.0 
- [repo versione laravel 10](https://github.com/Francescodc92/pizzeria-backend)
- [repo frontend (temporaneo)](https://github.com/Francescodc92/pizzeria-full-stack)

### Progetto db
![database-structure](./.github/db_pizzeria.png)

## TODO
  //admin 
  1 sistemare il componente di paginazione default di laravel
  2 !urgente aggiungere la lista di indirizzi nello show dell'utente (creare la show degli utenti)
    - valutare la possibilità di visualizzare nello show dell'utente una lista di ordini precedenti
    - creare un form per la creazione di una ordinazione (temporanea per testare la creazione)

  3 iniziare a lavorare sulla parte della dashboard (grafici per amministratore)

  //employee
  1 creare un layout per i dipendenti con un componente navigation specifico in modo da mostrare le rotte specifiche 
    - eliminare dalle rotte tutto quello che riguarda gli admin (creare delle visualizzazioni condizionali per le pagine esistenti o crearne di specifiche (meglio la prima opzione ))
  
  //utente (api)
  1. sistemare il frontend perche funzioni con il nuovo backend (temporaneamente)
      - sistemare l'autenticazione tramite api (già esistente nel progetto con laravel10 )
      - adattare le rotte api del progetto con laravel10 alle nuove rotte laravel11 (cambiare i campi modificati nel nuovo progetto)
      - aggiungere sistema di pagamento (creazione ordine ecc)
      - creare la rotta per la visualizzazione degli ordini dell'utente

### Tecnologie:
  - laravel 11
    - Breeze
    - sanctum
    - spatie (gestione dei ruoli)
  - docker
  - tailwind css
  - mySql 