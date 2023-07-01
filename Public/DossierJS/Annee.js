const addYear = document.querySelector("#addYear");
const Newyear = document.querySelector("#Newyear");
const url = "http://localhost:8000/";
Newyear.addEventListener("input",()=>
{
    
    if(valideYear(Newyear.value) !=0)
    {
        addYear.setAttribute("disabled", "true");
    }
    else
    {
        addYear.removeAttribute("disabled");
    }
})


addYear.addEventListener("click", ()=>
{
   
    let annee = Newyear.value.split("-");
    // console.log(annee[0] - annee[1]);
    let diff = annee[1] - annee[0];
    if( diff != 1)
    {
        console.log("annee invalide");
    }
    else 
    {
        console.log("good year");   
    }
  
  
})

function valideYear(data)
{
    let annee = data.split("-");
    let error = 0;
    if(!(validerDate(data))){error++}
    if(annee.length !=2){error++}
    return error;
}

function validerDate(date) {
    var pattern = /^\d{4}-\d{4}$/;
    return pattern.test(date);
}


