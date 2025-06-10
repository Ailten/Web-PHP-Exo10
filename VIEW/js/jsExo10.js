
//when window loaded.
window.addEventListener("load", function(){

    //when change value of champ in form.
    $("input, select").on("change", function ()
    {
        VerifyChampForm(this);
    });

    //when the form is submit.
    $("form[name=FORM]").on("submit", function ()
    {
        let allChampOnForm = $("form[name=FORM] input, form[name=FORM] select");
        let boolAllChampIsValide = true;
        for(let i=0; i<allChampOnForm.length; i++)
        {
            if(!VerifyChampForm(allChampOnForm[i]))
            {
                boolAllChampIsValide = false;
                //break; //don't break ! for apply error span for all champs.
            }
        }

        return boolAllChampIsValide;
    });
});

function VerifyChampForm(domChamp)
{
    if (domChamp.getAttribute("type") == "submit") //submit input is every type valide.
        return true;

    let valueInput = domChamp.value;
    let inputRequired = domChamp.hasAttribute("required");
    let idInput = domChamp.getAttribute("id");
    let spanError = document.getElementById(idInput+"_ERROR");

    //champs vide and required.
    if(inputRequired && valueInput.trim().length == 0)
    {
        spanError.innerHTML = "Ce champ est vide !";
        return false;
    }

    //champs with value not contractual.
    if(!testRegex(idInput, valueInput))
    {
        spanError.innerHTML = "information invalide !";
        return false;
    }

    //champs valide.
    spanError.innerHTML = "";
    return true;
}

function testRegex(id, value)
{
    switch(id){
        case("PSEUDO"):
            return (/^[a-z0-9-]{3,15}$/i).test(value); //all lettre and num (+maj and char "-") max 15 char.
            break;
        case("SEXE"):
            return (/^[GFA]$/i).test(value); //only one of this 3 letter.
            break;
        case("AGE"):
            return (/^[1]?[0-9]{1,2}$/i).test(value); //number from 0 to 199 both include.
            break;
    }
}