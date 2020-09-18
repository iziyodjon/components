<?php


class Router
{
    public function run($rules,$path){

        foreach($rules as $rule){

            if(preg_match($rule,$path,$matches)){
                $uri = explode('/',$matches[0]);
                $page = $uri[1];
                $id = $uri[2];
            }
        }
        if(file_exists(ROOT."/pages/".$page.".php")){
            require_once ROOT."/pages/".$page.".php";
        }elseif(empty($page)){
            require_once ROOT."/pages/homepage.php";
        }else{
            var_dump(404);
        }
    }
}