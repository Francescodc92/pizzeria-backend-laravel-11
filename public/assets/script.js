const confirmation = (event) => {
    event.preventDefault();
    let formElement = event.currentTarget;

    swal({
        title: `Sei sicuro di voler eliminare questo elemento?`,
        text: "Non sarai in grado di recuperarlo dopo l'eliminazione.",

        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willcancel) => {
        if (willcancel) {
            formElement.submit();
        }
    });
};

const toggleDarkMode = () => {
    const htmlElement = document.documentElement;
    htmlElement.classList.toggle("dark");

    if (htmlElement.classList.contains("dark")) {
        localStorage.setItem("theme", "dark");
    } else {
        localStorage.setItem("theme", "light");
    }
};

document.addEventListener("DOMContentLoaded", () => {
    const theme = localStorage.getItem("theme");
    if (theme === "dark") {
        document.documentElement.classList.add("dark");
    }
});
