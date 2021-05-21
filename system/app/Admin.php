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
    
    static public function editDomains(){
        $data =  Db::all("select * from domains");        
        Template::render('adminDomainsList', ['data' => $data]);
    }

    static public function saveDomain(){
        Db::all(
            "UPDATE domains SET `on`='0'"
        );
        $id = $_POST['id'];
        Db::exec(
            "UPDATE domains SET `on`=1 WHERE id=?",[$id]
        );
        echo json_encode(["status"=>200]);
        
    }
    
    static public function saveTemplate(){
        
    }
    
}
