<?php

class Form2
{
    private $name; //attributes of form.
    private $method;
    private $action;

    private $champs; //all champs input form.
    private $inputSubmitDone; //if input submit are call.

    //instantiate object Form with attributes.
    public function __construct($name='FORM', $method='post', $action='#')
    {
        $this->name = $name; //stock attributes of form.
        $this->method = $method;
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
                      id="'.$this->name.'"
                      method="'.$this->method.'"
                      action="'.$this->action.'">'.
            $this->champs.
            '</form>';
    }

    //add input test in form.
    public function setText($label, $name, $placeholder, $required=false, $value='')
    {
        $this->setInput($label, $name, $placeholder, $value, $required, 'text');
    }

    //add input email in form.
    public function setEmail($label, $name, $placeholder, $required=false, $value='')
    {
        $this->setInput($label, $name, $placeholder, $value, $required, 'email');
    }

    //add input int in form.
    public function setInt($label, $name, $placeholder, $min='', $max='', $required=false, $value='')
    {
        $this->setInput($label, $name, $placeholder, $value, $required, 'number', $min, $max);
    }

    //add select/option (drop liste) in form.
    public function setDropListe($label, $name, $valuesAndLibeles, $required=false)
    {
        $this->champs .=
            '<p>
             <label for="'.$name.'">'.$label.'
                 <span id="'.$name.'_ERROR" class="errorRed"></span>
             </label>
             <br/>
             <select name="'.$name.'" 
                     id="'.$name.'"
                     '.(($required)? ' required': '').'>
                 <option value="">---</option>';

        for($i=0; $i<count($valuesAndLibeles); $i+=2)
            $this->champs .=
                '<option value="'.$valuesAndLibeles[$i].'">'.$valuesAndLibeles[$i+1].'</option>';

        $this->champs .=
            '</select>';
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
    private function setInput($label, $name, $placeholder, $value, $required, $type, $min='', $max='')
    {
        $this->champs .=
            '<p>'.
            '<label for="'.$name.'">'.$label.'
                 <span id="'.$name.'_ERROR"
                       class="errorRed"></span>
             </label>
             <br/>
             <input type="'.$type.'" 
                    name="'.$name.'" 
                    id="'.$name.'" 
                    '.(($type=='email')? 'class="EMAIL_FORM"':'').'
                    placeholder="'.$placeholder.'" 
                    '.(($value!='')? 'value="'.$value.'"': '').' 
                    '.(($type=='number' && $min!='')? 'min="'.$min.'"': '').' 
                    '.(($type=='number' && $max!='')? 'max="'.$max.'"': '').' 
                    '.(($required)? 'required': '').'/>'.
             '</p>';
    }
}