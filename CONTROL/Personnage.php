<?php

class Personnage
{
    private $force = 20;
    private $damage = 20;
    private $lifePoint = 100;
    private $exp = 1;
    private $name = "NoName";

    private $infoFigth = ""; //stock info html to write.

    public function __construct($force=50, $damage=10, $lifePoint=100, $name="NoName")
    {
        $this->force = $force;
        $this->damage = $damage;
        $this->lifePoint = $lifePoint;
        $this->exp = 1;
        $this->name = $name;
    }

    //write data of personnage.
    public function presente(){
        return $this->name.
            ' à '.
            $this->getForce().
            ' de force et '.
            $this->getLife().
            ' point(s) de vie.'.
            '<br/>';
    }

    //execute a figth betwin two personne (this and ennemy).
    public function combat($ennemy)
    {
        $this->infoFigth = "";

        //fight continue when both in life
        $turnToHit=false;
        while($this->InLife() &&
            $ennemy->InLife()){

            //one hit by turn, personne by personne.
            if($turnToHit=!$turnToHit)
                $this->hit($ennemy);
            else
                $ennemy->hit($this);
        }

        //write all.
        return $this->infoFigth;
    }

    //--------------->>

    //ask if personne is in life, or dead (true or false).
    public function InLife(){
        return ($this->lifePoint > 0);
    }

    //this hit ennemy and write in echo.
    public function hit($ennemy)
    {
        //hit and write.
        $ennemy->takeDamage($this->calculDamage($ennemy));
        $this->addInfoFigth($this->name.
            ' frape '.
            (string)$ennemy->getName().
            ' avec '.
            (string)$this->calculDamage($ennemy).
            ' point(s) de degats !'.
            '<br/>' ,$ennemy); ;

        //gain exp and write.
        $this->gainExp(1);
        $this->addInfoFigth($this->name.
            ' à '.
            (string)$this->exp.
            ' point(s) d\'experiance !'.
            '<br/>', $ennemy);

        $this->addInfoFigth( (!$ennemy->inLife())? //if Playeur is dead write death ennemy.
            $ennemy->getName().
            ' est mort !'.
            '<br/>'
            : //else write lifePoint ennemy.
            $ennemy->getName().
            ' à encore '.
            (string)$ennemy->getLife().
            ' point(s) de vie !'.
            '<br/>', $ennemy);
    }

    //getter force.
    public function getForce(){
        return $this->force;
    }

    //getter damage.
    public function getDamage(){
        return $this->damage;
    }

    //getter lifePoint.
    public function getLife(){
        return $this->lifePoint;
    }

    public function getName(){
        return $this->name;
    }

    //take damage and substract of lifePoint.
    public function takeDamage($damageTaked){
        $this->lifePoint -= $damageTaked;
    }

    //gain exp, addition to exp.
    public function gainExp($expAdd){
        $this->exp += $expAdd;
    }

    //calcule damage of one hit.
    public function calculDamage($ennemy){
        return ($this->getForce() + $ennemy->getDamage());
    }

    public function addInfoFigth($add, $ennemy){
        $this->infoFigth .= $add;
        $ennemy->infoFigth .= $add;
    }

}