<?php


class SCR
{

    private $head = Array();
    private $footer = Array();

    public function __construct()
    {

    }


    public function js($src, $position = 'footer'){
        if($position == 'footer') {
            $this->footer[] = "<script src=\"$src\"></script>";
        }elseif($position == 'head'){
            $this->head[] = "<script src=\"$src\"></script>";
        }
    }

    public function css($href, $position = 'head'){
        if($position == 'head') {
            $this->head[] = "<link type=\"text/css\" rel=\"stylesheet\" href=\"$href\">";
        }elseif($position == 'footer'){
            $this->footer[] = "<link type=\"text/css\" rel=\"stylesheet\" href=\"$href\">";
        }
    }

    public function head(){
        foreach ($this->head as $element){
            echo $element;
        }
    }

    public function footer(){
        foreach ($this->footer as $element){
            echo $element;
        }
    }
}