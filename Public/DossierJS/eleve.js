// alert("hjd:jsk!m,");

const semestre = document.querySelector("#semestre");
const noteChoisie = document.querySelector("#noteChoisie");
const discipline = document.querySelector("#discipline");
const noteEleve = document.querySelectorAll(".noteEleve");
const port = "http://localhost:8000/";
console.log(semestre.value)

semestre.addEventListener("change", () => {
    console.log(semestre.value)
})


noteChoisie.addEventListener("change", () => {
    if (noteChoisie.value != "" && discipline != "") {
        // console.log("sezam ouvre toi");
        noteEleve.forEach(d => {
            d.classList.remove("d-none");
            d.classList.add("d-flex");
        });
        let objet = {
            idDiscipline: discipline.value,
            typeNote: noteChoisie.value
        }
        let typeNote = noteChoisie.value
        console.log(typeNote);
        fetchPost(port + "eleve/note", objet)
            .then(data => {
                data.forEach(d => {
                    console.log(d[typeNote])
                });
            })
    }
    else {
        console.log("sézam ferme toi");
        noteEleve.forEach(d => {
            d.classList.remove("d-flex");
            d.classList.add("d-none");
        });
    }
})


discipline.addEventListener("change", () => {
    if (noteChoisie.value != "" && discipline.value != "") {
        noteEleve.forEach(d => {
            d.classList.remove("d-none");
            d.classList.add("d-flex");
        });
        let objet = {
            idDiscipline: discipline.value,
            typeNote: noteChoisie.value
        }
        let typeNote = noteChoisie.value
        console.log(typeNote);
        fetchPost(port + "eleve/note", objet)
            .then(data => {
                data.forEach(d => {
                    console.log(d[typeNote])
                });
                // console.log(data)
            })
        // console.log("sezam ouvre toi");
    }
    else {
        noteEleve.forEach(d => {
            d.classList.remove("d-flex");
            d.classList.add("d-none");
        });
        // console.log("sézam ferme toi");
    }
})




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