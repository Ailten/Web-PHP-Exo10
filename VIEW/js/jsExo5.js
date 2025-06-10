
var timeForChrono; //variable global pour chrono.
var myIntervalFunction; //for clear interval function.

//execute apré l'html.
window.addEventListener("load", function (){

    //input click for switch style.
    document.getElementById("SwitchStyleInput").addEventListener("click", function (event){
        let buttonClick = event.target;
        let paramValueSwitch = parseInt(buttonClick.getAttribute("paramValueSwitch"));
        let listDomWantToSwitch=document.getElementsByClassName("ParagraphStyle_"+paramValueSwitch);
        console.log(listDomWantToSwitch);
        const innerButtonSwitch=["White Mode", "Dark Mode"];

        //switch param value, 0 to 1, 1 to 0.
        paramValueSwitch=(paramValueSwitch+1)%2;

        //edit all.
        buttonClick.setAttribute("paramValueSwitch", paramValueSwitch);
        buttonClick.setAttribute("value", innerButtonSwitch[paramValueSwitch]);
        while (listDomWantToSwitch.length != 0){ //list pop a chaque remove class.
            //add new class.
            listDomWantToSwitch[0].classList.add("ParagraphStyle_"+paramValueSwitch);
            //remove last class.
            listDomWantToSwitch[0].classList.remove("ParagraphStyle_"+(Math.abs(paramValueSwitch-1)));
        }

    }); //end event button Switch style.

    //---------------->> Exo Chrono. <<--------------------//

    //click input Start chrono.
    document.getElementById("ChronoStart").addEventListener("click", function (event){
        timeForChrono=0; //set chrono to 0.
        event.target.setAttribute("disabled", "true"); //unactive button.
        document.getElementById("ChronoReset").removeAttribute("disabled"); //active reset button.

        //My function inverval.
        intervalUpdateChrono();
    });

    //Click input Pause chrono.
    document.getElementById("ChronoPause").addEventListener("click", function (event) {
        //get bool is in pause.
        let paramInPause=event.target.getAttribute("paramInPause");

        //switch pause bool.
        paramInPause=(paramInPause=="true")? "false": "true";

        //process pause or un-pause.
        if (paramInPause=="true"){
            clearInterval(myIntervalFunction); //pause.
        }else{
            intervalUpdateChrono(); //un-pause. (but no reset.)
        }

        //set pause param.
        event.target.setAttribute("paramInPause", paramInPause);
    });

    //Click input Reset chrono.
    document.getElementById("ChronoReset").addEventListener("click", function (event) {
        clearInterval(myIntervalFunction);
        timeForChrono=0;
        WriteChrono();

        //unactive reset button.
        event.target.setAttribute("disabled","true");
        //re-active start button.
        document.getElementById("ChronoStart").removeAttribute("disabled");
    });

});

//time gestion.
const TIME_SEC=1000;
const TIME_MIN=1000*60;
const TIME_HOUR=1000*60*60;
const TIME_DAY=1000*60*60*24;

//function for output time in html.
function WriteChrono(){
    let ChronoOutput = document.getElementById("ChronoOutput");

    //separate all value time.
    let miliSec=timeForChrono%TIME_SEC;
    let sec=(timeForChrono -miliSec)%TIME_MIN;
    let min=(timeForChrono -miliSec -sec)%TIME_HOUR;
    let hour=(timeForChrono -miliSec -sec -min)%TIME_DAY;

    //adapte mili sec to true value.
    sec/=TIME_SEC;
    min/=TIME_MIN;
    hour/=TIME_HOUR;

    //write output in dom html.
    ChronoOutput.innerHTML=hour+"h "+
                           min+"min "+
                           sec+"sec";
}

function intervalUpdateChrono(){
    myIntervalFunction=setInterval(function(){
        timeForChrono+=100; //add time to wait interval.
        WriteChrono();
    }, 100);
}