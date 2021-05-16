<?php

class Admin
{
    public function show_edit_form(){
        
    }
    
    public function check_is_admin($user_id){
        
    }
    
    static public function editTemplate(){
        $data =  Db::field("select content from templates where id = 1");
        Template::render('quizTemplate', ['data' => $data, 'isBaseTemplate' => true]);
    }
    
    static public function saveTemplate(){
        
    }
    
}
