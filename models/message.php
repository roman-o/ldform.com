<?php
/**
 * Created by PhpStorm.
 * User: win-ivan
 * Date: 25.04.2016
 * Time: 17:25
 */
class Message extends Model
{
    public function save($data,$id=null){
        if(!isset($data['name']) || !isset($data['email']) || !isset($data['message'])){
            return false;
        }
        $id=(int)$id;
        $name=$this->db->escape($data['name']);
        $email=$this->db->escape($data['email']);
        $message=$this->db->escape($data['message']);

        if(!$id){//add new
            $sql="INSERT INTO messages SET name='{$name}',email='{$email}',message='{$message}'";
        }else{//update
            $sql="UPDATE messages SET name='{$name}',email='{$email}',message='{$message}' WHERE id={$id}";
        }
        return $this->db->query($sql);
    }
    public function getList(){
        $sql='SELECT * FROM messages';
        return $this->db->query($sql);
    }
}