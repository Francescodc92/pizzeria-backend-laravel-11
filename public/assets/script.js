const confirmation = (event) => {
  event.preventDefault();
  let  formElement = event.currentTarget;

  swal({
      title: `Sei sicuro di voler eliminare questo elemento?`,
      text: "Non sarai in grado di recuperarlo dopo l'eliminazione.",
      
      icon: "warning",
      buttons: true,
      dangerMode: true
  })

  .then((willcancel) => {
      if(willcancel) {
          formElement.submit();
      }
  });
}