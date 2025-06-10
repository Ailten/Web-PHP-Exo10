
//when window are full loaded.
window.addEventListener("load", function (){

    //when input NOM is editing value.
    $("input[name='NOM']").on("change", function (event){

        //print error if dont match to regex NOM.
        $("label[for='NOM']>span").html(
            (VerifyNOM(this.value))? "":
            "champ invalide. une virgule est attendue.");

    });

    //simule event for re-active error.
    if (document.getElementById("POST_OK")) //if POST.
        document.getElementById("NOM").dispatchEvent(new MouseEvent('change'));

    //when input EMAIL is editing value.
    $("input[name='EMAIL']").on("change", function (event){

        //print error if dont match to regex NOM.
        $("label[for='EMAIL']>span").html(
            (VerifyEMAIL(this.value))? "":
            "champ invalide! absence d'arobase et de point.");

    });

    //simule event for re-active error.
    if (document.getElementById("POST_OK")) //if POST.
        document.getElementById("EMAIL").dispatchEvent(new MouseEvent('change'));

    //button deconnection click.
    $("input[id='DECO']").on("click", function (){
        /*
        //unckeck ultilisateur OK.
        let utilisateurOK = document.getElementById("UTILISATEUR_OK");
        if (utilisateurOK){
            utilisateurOK.removeAttribute('checked');
        }

        //erase name save.
        let utilisateurNOM = document.getElementById("UTILISATEUR_NOM");
        if (utilisateurNOM){
            utilisateurNOM.setAttribute("value", "");
        }

        //erase NOM and EMAIL.
        document.getElementById("NOM").value = "";
        document.getElementById("EMAIL").value = "";
        */

        //erase all paragraph in form.
        let myForm = document.getElementById("MyFormTest");
        let allParagraph = myForm.getElementsByTagName("p");
        while(allParagraph.length!=0)
            myForm.removeChild(allParagraph[0]);

        //simulate a submit for refresh.
        document.getElementById("SUBMIT").click();
    });

    //submit button click.
    $("input[id='SUBMIT']").on('click', function (){

        if (VerifyNOM(document.getElementById("NOM").value) && //nom valide.
            VerifyEMAIL(document.getElementById("EMAIL").value)){ //and email valide.

            //set value for save.
            document.getElementById("UTILISATEUR_OK").setAttribute("checked", "true");
            document.getElementById("UTILISATEUR_NOM").value = document.getElementById("NOM").value;

            //valide formulaire. ---->>

        }else{
            alert("champ(s) invalide(s).");

            //un-valide formulaire. ---->>

        }

    });
});

function VerifyNOM(value){
    return (/^[a-z]{2,}(,|, )[a-z]{2,}$/i).test(value);
}
function VerifyEMAIL(value){
    return (/^.{1,}@.{1,}[.].{2,4}$/i).test(value);
}
