## Backend Progetto finale 2.0 
- [repo versione laravel 10](https://github.com/Francescodc92/pizzeria-backend)
- [repo frontend (temporaneo)](https://github.com/Francescodc92/pizzeria-full-stack)

### Progetto db
![database-structure](./.github/db_pizzeria.png)

## TODO
  ### Admin 
  4. (da pensare ) un grafico per il numero di utenti registrati se necessario
  5. aggiungere un filtro in base al ruolo dell'utente 

  ### Employee  
  2. aggiungere un filtro in base al ruolo dell'utente 
      
  ### User
  1. creare una rotta dove mandare gli user (se fanno il login dal backend) tipo una welcome con il link per riportare al frontend
  ### User (api)
  decidere se modificare il vecchio frontend o se ricostruirlo da 0 (molto probabilmente ricostruirlo)
  1. sistemare il frontend perche funzioni con il nuovo backend (temporaneamente)
      - adattare le rotte api del progetto con laravel10 alle nuove rotte laravel11 (cambiare i campi modificati nel nuovo progetto)
      - creare la rotta per la visualizzazione degli ordini dell'utente
      - creare le rotte per le pizze
        - implementare il ritorno delle sole pizza disponibili 
  2. permettere all'utente di poter eliminare gli ordini che ha fatto in precedenza (aggiungere un campo nella tabella che servirà a non far ritornare quell'ordine al frontend)


  ### future aggiunte
  1. aggiungere una tabella ingredienti per dare opzione di cambiare ingrediente specifico
  2. aggiungere una tabella dipendenti specifica dove inserire i dati dei contratti (scadenza, retribuzione, ruolo specifico ecc )
  3. parte di gestione specifica dei dipendenti 

### Tecnologie:
  - laravel 11
    - Breeze
    - sanctum
    - spatie (gestione dei ruoli)
  - docker
  - tailwind css
  - mySql 