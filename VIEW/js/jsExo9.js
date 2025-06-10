
//when window loaded.
window.addEventListener("load", function(){
    //for all email input, when it change value.
    let arrayOfEmailInput = document.getElementsByClassName("EMAIL_FORM");
    for(let i=0; i<arrayOfEmailInput.length; i++){
        arrayOfEmailInput[i].addEventListener("change", function(event){
            let inputEmail = event.target; //stock this input.
            let valueEmail = inputEmail.value; //stock this input value.
            let idEmail = inputEmail.getAttribute("id"); //stock id of this input.
            let spanError = document.getElementById(idEmail+"_ERROR"); //stock span for error this input.

            if(!spanError){ //if span error is not find in html.
                console.log("spanERROR form not found !");
                return;
            }

            spanError.innerHTML=(!(/^.{1,}@.{1,}[.].{2,4}$/i).test(valueEmail))?
                "champ invalide !": //if email input is valide.
                ""; //if email input is not valide, errase span error message.
        });
    }

    /*
    //submit input form, when click.
    document.getElementById("SUBMIT_FORM").addEventListener('click', function (event){
        let inputSubmit = event.target;
        let theForm = inputSubmit.form;
        console.log(theForm);
    });
    */

    //when user submit form.
    document.getElementById("SUBMIT_FORM").form.addEventListener('submit', function (event){
        let theForm = event.target;
        let boolFormValide = true;
        let allInput = theForm.getElementsByTagName("input");

        //verify all inputs.
        for(let i=0; i<allInput.length && boolFormValide; i++){
            let value = allInput[i].value;
            let type = allInput[i].getAttribute("type");

            //if email input and not conforme.
            if(type=='email' && !(/^.{1,}@.{1,}[.].{2,4}$/i).test(value))
                boolFormValide=false;

            if(value.trim()=="") //if value empty.
                boolFormValide=false;
        }

        if(!boolFormValide)
            alert("champs invalide !");

        return boolFormValide;
    });

    //all input of form, verify empty champs.
    let allInput=document.getElementById("SUBMIT_FORM").form.getElementsByTagName("input");
    for (let i=0; i<allInput.length; i++){
        allInput[i].addEventListener('change', function (event){
           let input = event.target;
           let value = input.value;
           let spanError = document.getElementById(input.getAttribute('id')+"_ERROR");

           spanError.innerHTML=(value.trim() == '')?
               "champ invalide !":
               "";
        });
    }
});