const niveau = document.querySelector("#Disciplineniveau");
const classe = document.querySelector("#ClasseNew");
const nouveauGD = document.querySelector("#submitNewDisciplineGroupe");
const inputNewGD = document.querySelector("#newDisciplineGroup");
const alert = document.querySelector(".alert");
const addModal = document.querySelector("#addModal");
const messageReussi = document.querySelector(".reussi");
const GDiscipline = document.querySelector("#GDiscipline");
const newdiscipline = document.querySelector("#newdiscipline");
const buttonOk = document.querySelector("#buttonOk");
const messError = document.querySelector("#messError");
const divCheckBox = document.querySelector("#divCheckBox");
const btnUpdate = document.querySelector("#btnMettreAjour");
const nomClasse = document.querySelector(".nomClasse");
const port = "http://localhost:8000/";


btnUpdate.setAttribute("disabled", "true");


//Ajout des écouteurs d'événements//

buttonOk.setAttribute("disabled", "true");

/* Ajout d'un écouteur d'évènement sur le select des groupes de niveaux. Ce dernier permettra de charger les classes selon le groupe de niveau choisi */
niveau.addEventListener("change", () => {
  divCheckBox.innerHTML = '';
  fetchGet(port + "Discipline/classe/" + niveau.value)
    .then(data => {
      classe.innerHTML = '';
      divCheckBox.innerHTML = '';
      let option1 = document.createElement("option");
      option1.value = "";
      option1.textContent = "choisir une classe";
      classe.appendChild(option1);

      data.forEach(d => {
        let option = document.createElement("option");
        option.classList.add("classe");
        option.value = d.id_classe;
        option.textContent = d.libelle_classe;
        classe.appendChild(option);
      });
    })
})

/* Ajout d'un écouteur d'évènement sur un l'option nouveau du select des groupes de disciplines  */
nouveauGD.addEventListener("click", () => {
  if (inputNewGD.value == '') {
    alert.classList.remove("d-none");
    alert.classList.add("d-block");
    alert.textContent = "Vous n'avez saisie aucune discipline";
    setTimeout(() => {
      alert.classList.add("d-none");
      alert.classList.remove("d-block");

    }, 2000);
  }
  else {
    let objet = {
      groupeDiscipline: inputNewGD.value
    }

    fetchPost(port + "discipline/addGroupeDiscipline", objet)
      .then(data => {
        console.log(Object.keys(data).length)

        if (Object.keys(data).length != 1) {
          let option = document.createElement("option");
          option.value = data.id_GroupeDiscipline;
          option.textContent = data.libelle_GroupeDiscipline;
          GDiscipline.appendChild(option);
        }
        // message(data.message, messageReussi);)
        message(data.message, messageReussi);
        // console.log(data.length);
        console.log(data);
      });

  }
  // addModal.classList.add("d-none");
})


GDiscipline.addEventListener("change", () => {
  if (newdiscipline.value.length >= 3 && GDiscipline.value != "null" && GDiscipline.value != "nouveau" && classe.value != "") {
    buttonOk.removeAttribute("disabled");
  }
  else {
    buttonOk.setAttribute("disabled", "true");
  }
})

classe.addEventListener("change", () => {
  console.log(classe.value);
  if (classe.value === "") {
    divCheckBox.innerHTML = '';
  } else {
    nomClasse.removeAttribute("href");
    nomClasse.setAttribute("href", "/coefficient/coefficient/" + classe.value);
    let allClasse = document.querySelectorAll(".classe");
    allClasse.forEach(a => {
      if (a.value === classe.value) {
        nomClasse.textContent = a.textContent;
      }

    });
    fetchGet(port + "discipline/alldisciplineByClasse/" + classe.value)
      .then(data => {
        console.log(data.length);
        if (data.length === 0) {
          divCheckBox.innerHTML = '';
          messError.classList.remove("text-success", "d-none");
          messError.classList.add("text-danger", "d-flex");
          messError.textContent = "Aucune discipline pour cette classe";
          btnUpdate.setAttribute("disabled", "true");
        }
        else {
          messError.classList.add("text-success", "d-none");
          messError.classList.remove("text-danger", "d-flex");
          createCheckBox(data, divCheckBox);

        }
      })
  }
  //------------CONTROLLE POUR L'AJOUT D'UNE NOUVELLE DISCIPLINE;
  if (newdiscipline.value.length >= 3 && GDiscipline.value != "null" && GDiscipline.value != "nouveau" && classe.value != "") {
    buttonOk.removeAttribute("disabled");
  }
  else {
    buttonOk.setAttribute("disabled", "true");
  }
})
inputNewGD.addEventListener("change", () => {
  if (newDisciplineGroup.value === "") {
    submitNewDisciplineGroupe.removeAttribute("data-bs-dismiss");

  }
  else {
    submitNewDisciplineGroupe.setAttribute("data-bs-dismiss", "modal")
    // console.log()
  }
})

newdiscipline.addEventListener("input", () => {
  //console.log(newdiscipline.value.length);
  if (newdiscipline.value.length >= 3 && GDiscipline.value != "null" && GDiscipline.value != "nouveau" && classe.value != "") {
    buttonOk.removeAttribute("disabled");
    let objet = {
      Gdiscipline: GDiscipline
    }
  }
  else {
    buttonOk.setAttribute("disabled", "true");
  }

})

btnUpdate.addEventListener("click", () => {
  let inputs = document.querySelectorAll(".form-check-input");
  let tab = [];
  inputs.forEach(input => {
    // btnUpdate.removeAttribute("disabled");
    if (!(input.checked)) {

      tab.push(input.value);
    }
  });
  if(tab.length == 0)
  {
    message("Veuiller decocher une case pour supprimer la discipline", messageReussi);
  }
  else 
  {
    

    fetchPost(port + "discipline/delete/", tab)
      .then(data => {
        /* *
          * Suppression de tous les checkbox qui n'ont pas été checké;
         */
        inputs.forEach(input => {
          // btnUpdate.removeAttribute("disabled");
          if (!(input.checked)) {
      
            // tab.push(input.value);
             divCheckBox.removeChild(input.parentNode);
          }
        });
        inputs = document.querySelectorAll(".form-check-input")
        if(inputs.length === 0)
        {
          messError.classList.remove("text-success", "d-none");
          messError.classList.add("text-danger", "d-flex");
          messError.textContent = "Aucune discipline pour cette classe";
        }
        // console.log(data);
        message(data.message, messageReussi)
      })
  }
 

})

//Evénement sur le bouton ok pour l'ajout d'une nouvelle discipline;
// 
buttonOk.addEventListener("click", () => {
  let objet = {
    discipline: newdiscipline.value,
    groupeDiscipline: GDiscipline.value,
    classe: classe.value
  };
  fetchPost(port + "discipline/addDiscipline/", objet)
    .then(data => {
      // console.log(data.data.message);
      // console.log(data.data.code);
      message(data.data.message, messageReussi);
      newdiscipline.value = "";
      messError.innerText = "";
      createCheckBox(data.data.disciplines, divCheckBox);
    })
})


// buttonOk.addEventListener("mouseenter", ()=>{
//   buttonOk.setAttribute("title", "vous devez choisir une classe, un groupe de discipline , et saisir le nom de la discipline pour activer le bouton");
// })
// buttonOk.addEventListener("mousehover", ()=>{
//   buttonOk.removeAttribute("title");
// })

//------------------------------------------------------------------------------------------------------------------------------------------------------
// Fonctions utilisées


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

function code(discipline) {
  // let chaine = discipline
  let tableau = discipline.split(" ");
  let code = "";
  if (tableau.length === 1) {
    code = discipline.substring(0, 3);
  }
  else {
    for (let i = 0; i < tableau.length; i++) {
      code += tableau[i][0];

    }

  }
  return code;
}


function createCheckBox(data, divinput) {
  messError.classList.add("text-success", "d-none");
  messError.classList.remove("text-danger", "d-flex");
  divinput.innerHTML = '';
  data.forEach(d => {
    let div = document.createElement("div");
    div.classList.add("d-flex", "flex-column", "fw-bold");
    div.innerHTML = `
                  <label class="form-check-label" for="inlineCheckbox1">${d.libelle_discipline} <span>(${d.code_discipline})</span> </label>
                  <input class="form-check-input input" type="checkbox" id="inlineCheckbox1" checked value="${d.id_dis}">`;
    divinput.appendChild(div);
  });
  let inputs = document.querySelectorAll(".form-check-input")
  inputs.forEach(input => {
    input.addEventListener("change", () => {
      btnUpdate.removeAttribute("disabled");
      input.classList.toggle("bg-danger");
      console.log(input);
    })

  });

}
// function 