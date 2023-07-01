// alert("wou");
const submit = document.querySelector("#submit");
const typePasswordX = document.querySelector("#typePasswordX");
const typeEmailX = document.querySelector("#typeEmailX");
const port = "http://localhost:8000/"

submit.addEventListener("click", (e)=>
{
    e.preventDefault();
    if(typeEmailX.value == '' || typePasswordX == '')
    {
        alert("veuiller rensigner tous les champs")

    }
    else 
    {

        let objet = 
        {
            login : typeEmailX.value, 
            passWord : typePasswordX.value
        }
        fetch(port+"User/tryConnexion/", {
            method : "POST", 
            headers: {
                "Content-Type": "application/json"
              },
            body : JSON.stringify(objet)
        })
        // .then(response => response.json())
        // .then(data => {
        //     console.log(data);
        // }
          

        // console.log(objet);
    }
})