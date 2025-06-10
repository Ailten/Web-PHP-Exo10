
//execute in loading page.
window.addEventListener("load", function () {

    //event for button start click.
    document.getElementById("diviseur_start").addEventListener("click", function (event){
        let numberInput = parseInt(document.getElementById("diviseur_numberInput").value);
        let domOutput = document.getElementById("diviseur_output");

        //if champ vide or text.
        if(isNaN(numberInput)){
            domOutput.innerHTML = "Input invalide !";
            return;
        }

        //process. (without array)
        domOutput.innerHTML = "Number input : "+numberInput+"<br/>";
        domOutput.innerHTML += "Diviseur : 1, "; //first diviseur : 1.
        for(let i=2; i<numberInput; i++){
            if(numberInput%i==0)
                domOutput.innerHTML += i+", ";
        }
        domOutput.innerHTML += numberInput; //last diviseur.
    });

});