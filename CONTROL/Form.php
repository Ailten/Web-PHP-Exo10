<?php

class Form
{
    private $name; //attributes of form.
    private $id;
    private $methode;
    private $action;

    private $champs; //all champs input form.
    private $inputSubmitDone; //if input submit are call.

    //instantiate object Form with attributes.
    public function __construct($name='FORM', $id='FORM', $methode='post', $action='#', $jsInclude=true)
    {
        $this->name = $name; //stock attributes of form.
        $this->id = $id;
        $this->methode = $methode;
        $this->action = $action;

        $this->champs = ''; //initialise string for all input form.
        $this->inputSubmitDone = false; //initialise bool submit do.
    }

    //return all html form for write.
    public function getForm()
    {
        if(!$this->inputSubmitDone) //write submit if it's not done.
            $this->setSubmit();

        return '<form name="'.$this->name.'" 
                      id="'.$this->id.'"
                      methode="'.$this->methode.'"
                      action="'.$this->action.'">'.
            $this->champs.
            '</form>';
    }

    //add input test in form.
    public function setText($label, $name, $id, $placeholder, $value='', $required=false)
    {
        $this->setInput($label, $name, $id, $placeholder, $value, $required, 'text');
    }

    //add input email in form.
    public function setEmail($label, $name, $id, $placeholder, $value='', $required=false)
    {
        $this->setInput($label, $name, $id, $placeholder, $value, $required, 'email');
    }

    //add submit button.
    public function setSubmit($name='SUBMIT', $value='envoyer')
    {
        $this->inputSubmitDone = true;
        $this->champs .=
            '<input type="submit" 
                    name="'.$name.'" 
                    value="'.$value.'" 
                    id="SUBMIT_FORM"/>';
    }

    //---------------->> function private.

    //make input in form.
    private function setInput($label, $name, $id, $placeholder, $value, $required, $type)
    {
        $this->champs .=
            '<p>'.
            '<label for="'.$name.'">'.$label.'
                 <span id="'.$id.'_ERROR"
                       class="errorRed"></span>
             </label>
             <br/>
             <input type="'.$type.'" 
                    name="'.$name.'" 
                    id="'.$id.'" 
                    '.(($type=='email')? 'class="EMAIL_FORM"':'').'
                    placeholder="'.$placeholder.'" 
                    '.(($value!='')? 'value="'.$value.'"': '').' 
                    '.(($required)? 'required': '').'/>'.
             '</p>';
    }
}