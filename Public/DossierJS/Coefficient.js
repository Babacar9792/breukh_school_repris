// alert("lfjk;qvj kgkq");

let inputs = document.querySelectorAll("input");
const mettreAjour = document.querySelector("#mettreAjour");
const messageReussi = document.querySelector(".reussi");
const examen = document.querySelectorAll(".examen");
const deleteDiscipline = document.querySelectorAll(".bi-backspace");
const port = "http://localhost:8000/";

inputs.forEach(d => {
    d.addEventListener("change", () => {
        if (d.value < 10 || d.value == '') {
            message("Toutes les notes d'examens doivent être supérieur ou égale à 10", messageReussi);
        }
        else {

            d.classList.add("change");
        }

    })

});


mettreAjour.addEventListener("click", () => {
    let changes = document.querySelectorAll(".change");
    let tab = [];
    changes.forEach(d => {
        let id = d.getAttribute("id");
        let info = id.split("_");
        let objet = {
            typeNote: info[0],
            idNote: info[1],
            valeur: d.value
        }
        tab.push(objet)
    });
    if (tab.length === 0) {
        message("Aucune données n'a été modifiée", messageReussi)
    }
    else {

        fetchPost(port + "coefficient/updateCoefficient", tab)
            .then(data => {
                // console.log(data);
                message(data.message, messageReussi);
            })
    }
    // console.log(tab)
})


examen.forEach(e => {
    e.addEventListener("input", () => {
        if (e.value < 10) {
            e.classList.add("text-danger")
        }
        else {
            e.classList.remove("text-danger")
            e.classList.add("text-success")

        }
    })
});


deleteDiscipline.forEach(e => {
    e.addEventListener("click", ()=>{
        let id = e.getAttribute("idDiscipline");
        fetchGet(port+"coefficient/deleteDiscipline/"+id)
        .then(data => { console.log(data)});
        console.log(e.getAttribute("idDiscipline"));
    })
});


function fetchGet(url) {
    return fetch(url)
        .then(response => response.json())
        .then(data => {
            return data;
        });

}

function fetchPost(url, objet) {
    return fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(objet)
    })
        .then(response => response.json())
        .then(data => data);
}


function message(texte, div) {
    div.classList.remove("d-none");
    div.classList.add("d-flex");
    div.textContent = texte;
    setTimeout(() => {
        div.classList.add("d-none");
        div.classList.remove("d-flex");

    }, 2000);
}