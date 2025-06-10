
//execute in loading page.
window.addEventListener("load", function () {

    //when click button start puissance4.
    document.getElementById("puissance4_start").addEventListener("click", function (event){
        //get name.
        let NamePlayeurOne = document.getElementById("playeur_1").value;
        let NamePlayeurTwo = document.getElementById("playeur_2").value;

        //no name.
        if(NamePlayeurOne.length == 0)
            NamePlayeurOne="Joueur-Rouge";
        if(NamePlayeurTwo.length == 0)
            NamePlayeurTwo="Joueur-Jaune";

        //instance obj.
        ObjGame = new PuissanceQuatre(NamePlayeurOne, NamePlayeurTwo,  "ScorePuissance4");
        //create map.
        ObjGame.MakeDomPlayable(document.getElementById("GamePuissance4"));

        //unactive input.
        event.target.setAttribute("disabled", "true");
        document.getElementById("playeur_1").setAttribute("disabled", "true");
        document.getElementById("playeur_2").setAttribute("disabled", "true");
    });

});

//instance of class puissance 4.
var ObjGame;

//--->> class puissance 4.
function PuissanceQuatre(NamePlayeurOne, NamePlayeurTwo, idOfScore, WithLength=7, HeightLength=6){
    this.NamePlayeurOne = NamePlayeurOne; //nom des joueurs.
    this.NamePlayeurTwo = NamePlayeurTwo;

    this.WithLength = WithLength; //taille du terrain.
    this.HeightLength = HeightLength;

    this.arrayCelluleDom = []; //array dom cellule terrain.

    this.turnToRed = true; //tour au joueur 1 (rouge).
    this.gameWinning=false; //partie finie.

    this.domScore = document.getElementById(idOfScore);
    this.domTbodyScore;
    this.arrayVictory = [];

    this.MakeDomPlayable = function(seed){
        //si array déja build.
        if(this.arrayCelluleDom.length != 0){
            alert("dom déja construct.");
            return;
        }

        let table = seed.appendChild(document.createElement("table"));
        table.classList.add("P4_table"); //css.
        for(let y=0; y<this.HeightLength; y++){
            this.arrayCelluleDom.push([]);
            let currentTr = table.appendChild(document.createElement("tr"));
            for (let x=0; x<this.WithLength; x++){
                let newCellule = currentTr.appendChild(document.createElement("td"));
                newCellule.setAttribute("CellulePuissance4_Etat", 0); //cellule vide.
                newCellule.setAttribute("CellulePuissance4_valueX", x);
                newCellule.setAttribute("CellulePuissance4_valueY", y);
                newCellule.setAttribute("CellulePuissance4_nameInstance", this.NameInstance);

                //click cellule puissance 4.
                let instanceObjPuisQuatr=this;
                newCellule.addEventListener("click", function (event){
                    instanceObjPuisQuatr.ClickCellule(event);
                });

                this.arrayCelluleDom[y].push(newCellule);
            }
        }
    };

    this.ClickCellule = function (event){
        if(this.gameWinning){
            this.NewGame();
            return;
        }

        let valueXInArray = parseInt(event.target.getAttribute("CellulePuissance4_valueX"));

        //find cellule a remplire sur la colone.
        let celTarget;
        let yTarget;
        for(let y=this.HeightLength-1; y>=0; y--){
            let etat = parseInt(this.arrayCelluleDom[y][valueXInArray].getAttribute("CellulePuissance4_Etat"));
            if(etat!=0) //si cellule occupée.
                continue;
            celTarget=this.arrayCelluleDom[y][valueXInArray];
            yTarget=y;
            break;
        }

        //plu de place dans la colone.
        if(celTarget==undefined)
            return;

        celTarget.setAttribute("CellulePuissance4_Etat", (this.turnToRed)? 1: 2);
        celTarget.style.backgroundColor=(this.turnToRed)? "red": "yellow";
        this.turnToRed=!this.turnToRed;

        this.VerifyWin(valueXInArray, yTarget, (this.turnToRed)? 2: 1);
    };

    this.VerifyWin = function(x, y, valueVerifying){
        for(let i=0; i<AXIS_VERIFY.length; i++){ //parcour la liste des combinaison.
            for(let j=0; j<4; j++){ //parcour les 4 cellule.
                //si la cellule est hors terrain.
                if( (y+AXIS_VERIFY[i][j].y)>this.HeightLength-1 ||
                    (y+AXIS_VERIFY[i][j].y)<0 ||
                    (x+AXIS_VERIFY[i][j].x)>this.WithLength-1 ||
                    (x+AXIS_VERIFY[i][j].x)<0)
                    break;

                if(valueVerifying !=
                    this.arrayCelluleDom[y+AXIS_VERIFY[i][j].y]
                                        [x+AXIS_VERIFY[i][j].x].getAttribute("CellulePuissance4_Etat")) //si l'etat n'est pas celui du joueur qui vien de jouer.
                    break;

                else if (j == 3) { //si la dernière cellule est bonne.
                    this.Winner(valueVerifying);
                    return;
                }
            }
        }

        for (let x=0; x<this.WithLength; x++){ //if empty cellule find.
            if (this.arrayCelluleDom[0][x].getAttribute("CellulePuissance4_Etat")=="0")
                return;
        }
        this.Winner(3); //match null.
    };

    this.Winner = function (winnerIs){
        alert((winnerIs==1)? this.NamePlayeurOne + " est le gagnant !":
              (winnerIs==2)? this.NamePlayeurTwo + " est le gagnant !":
                                                         "Match nul !");
        this.gameWinning=true;
        this.arrayVictory.push(winnerIs);

        //build score table.
        if(this.arrayVictory.length == 1){
            let table = this.domScore.appendChild(document.createElement("table"));
            table.classList.add("P4_table_score"); //css.
            let thead = table.appendChild(document.createElement("thead"));
            let tr = thead.appendChild(document.createElement("tr"));
            tr.appendChild(document.createElement("th")).innerHTML = this.NamePlayeurOne;
            tr.appendChild(document.createElement("th")).innerHTML = this.NamePlayeurTwo;

            this.domTbodyScore = table.appendChild(document.createElement("tbody"));
        }

        //add last victory.
        let line = this.domTbodyScore.appendChild(document.createElement("tr"));
        line.appendChild(document.createElement("td")).innerHTML =
            (this.arrayVictory[this.arrayVictory.length-1]==1)? "1": "0";
        line.appendChild(document.createElement("td")).innerHTML =
            (this.arrayVictory[this.arrayVictory.length-1]==2)? "1": "0";
    };

    this.NewGame = function (){
        if(!confirm("Voulez vous re-jouez ?")) { //si annul la question.
            return;
        }

        this.gameWinning=false;
        this.turnToRed=true;

        for (let y=0; y<this.HeightLength; y++){
            for (let x=0; x<this.WithLength; x++){
                this.arrayCelluleDom[y][x].setAttribute("CellulePuissance4_Etat", 0); //cellule vide.
                this.arrayCelluleDom[y][x].removeAttribute("style"); //un-color background.
            }
        }
    }
}

const AXIS_VERIFY=[//axe horizontal.
                   [{x:-3, y: 0},{x:-2, y: 0},{x:-1, y: 0},{x: 0, y: 0}],
                   [{x:-2, y: 0},{x:-1, y: 0},{x: 0, y: 0},{x: 1, y: 0}],
                   [{x:-1, y: 0},{x: 0, y: 0},{x: 1, y: 0},{x: 2, y: 0}],
                   [{x: 0, y: 0},{x: 1, y: 0},{x: 2, y: 0},{x: 3, y: 0}],
                   //axe vertical.
                   [{x: 0, y:-3},{x: 0, y:-2},{x: 0, y:-1},{x: 0, y: 0}],
                   [{x: 0, y:-2},{x: 0, y:-1},{x: 0, y: 0},{x: 0, y: 1}],
                   [{x: 0, y:-1},{x: 0, y: 0},{x: 0, y: 1},{x: 0, y: 2}],
                   [{x: 0, y: 0},{x: 0, y: 1},{x: 0, y: 2},{x: 0, y: 3}],
                   //axe diagonale 1 \.
                   [{x:-3, y:-3},{x:-2, y:-2},{x:-1, y:-1},{x: 0, y: 0}],
                   [{x:-2, y:-2},{x:-1, y:-1},{x: 0, y: 0},{x: 1, y: 1}],
                   [{x:-1, y:-1},{x: 0, y: 0},{x: 1, y: 1},{x: 2, y: 2}],
                   [{x: 0, y: 0},{x: 1, y: 1},{x: 2, y: 2},{x: 3, y: 3}],
                   //axe diagonale 2 /.
                   [{x:-3, y: 3},{x:-2, y: 2},{x:-1, y: 1},{x: 0, y: 0}],
                   [{x:-2, y: 2},{x:-1, y: 1},{x: 0, y: 0},{x: 1, y:-1}],
                   [{x:-1, y: 1},{x: 0, y: 0},{x: 1, y:-1},{x: 2, y:-2}],
                   [{x: 0, y: 0},{x: 1, y:-1},{x: 2, y:-2},{x: 3, y:-3}],
                  ];