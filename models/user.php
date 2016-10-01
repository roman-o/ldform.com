<?php

class User extends Model{
    public function  getByLogin($login){
        $login = $this->db->escape($login);
        $sql = "select * from users where login = '{$login}' limit 1";
        $result = $this->db->query($sql);
        if( isset($result[0])){
            return $result[0];
        }
        return false;
    }
    public function  getByEmail($email){
        $login = $this->db->escape($email);
        $sql = "select * from users where email = '{$email}' limit 1";
        $result = $this->db->query($sql);
        if( isset($result[0])){
            return $result[0];
        }
        return false;
    }

    public function singUp($data,$hash,$id= null){
        if(!isset($data['login']) || !isset($data['email']) || !isset($data['password'])){
            return false;
        }
        $id=(int)$id;
        $login=$this->db->escape($data['login']);
        $email=$this->db->escape($data['email']);
        $password=$this->db->escape($hash);


        $sql="INSERT INTO users SET login='{$login}',email='{$email}',password='{$password}'";

        return $this->db->query($sql);
    }
    public function userProfile($login){
        if (!isset($login)){
           return false;
        }
        $login = $login=$this->db->escape($login);

        $sql = "Select id,login from users where login='{$login}'";
        return $this->db->query($sql);

    }

    public function createProgect($data, $id_user,$lastInsertIdTimeMark,$lastInsertIdFormMark){
        if (!isset($id_user)){
            return false;
        }
        $lastInsertIdTimeMark =$this->db->escape($lastInsertIdTimeMark);
        $lastInsertIdFormMark =$this->db->escape($lastInsertIdFormMark);
        $id_user =$this->db->escape($id_user);
        $progect_name=$this->db->escape($data['progect_name']);
        $progect_site=$this->db->escape($data['progect_site']);
        $sql = "INSERT INTO `ldform`.`project` (`id_progect`, `progect_name`, `progect_site`, `time_mark`, `form_mark`, `id_user`) VALUES (NULL, '{$progect_name}', '{$progect_site}', '{$lastInsertIdTimeMark}', '{$lastInsertIdFormMark}', '{$id_user}');";
        return $this->db->query($sql);

    }

    public function  lastInsertIdByUserId($id_user,$id_table,$name_table){
        $id_user =$this->db->escape($id_user);
        $id_table =$this->db->escape($id_table);
        $name_table =$this->db->escape($name_table);
        $sql = "SELECT MAX({$id_table}) as lastId  FROM $name_table  WHERE id_user = '{$id_user}'";
        return $this->db->query($sql);
    }

    public function createTimeMark($data,$user_id){
        $user_id = $this->db->escape($user_id);
        $work_day_from=$this->db->escape($data['work_day_from']);
        $work_day_until=$this->db->escape($data['work_day_until']);
        $saterday_day_from=$this->db->escape($data['saterday_day_from']);
        $saterday_day_until=$this->db->escape($data['saterday_day_until']);
        $sunday_day_from=$this->db->escape($data['sunday_day_from']);
        $sunday_day_until=$this->db->escape($data['sunday_day_until']);
        $time_zone=$this->db->escape($data['time_zone']);

        $sql = "INSERT INTO `ldform`.`time_mark` (`id_time_mark`, `time_zone`, `work_day_from`, `work_day_until`, `saterday_day_from`, `saterday_day_until`, `sunday_day_from`, `sunday_day_until`, `id_user`) VALUES (NULL, '{$time_zone}', '{$work_day_from}', '{$work_day_until}', '{$saterday_day_from}', '{$saterday_day_until}', '{$sunday_day_from}', '{$sunday_day_until}','{$user_id}');";
        return $this->db->query($sql);
    }

    public function  createFormMark($data,$user_id){
        $user_id = $this->db->escape($user_id);
        $mycolor=$this->db->escape($data['mycolor']);
        $title=$this->db->escape($data['title']);
        $preambula=$this->db->escape($data['preambula']);
        $button=$this->db->escape($data['button']);
        $success=$this->db->escape($data['success']);
        $foto_text=$this->db->escape($data['foto_text']);
        $foto=$this->db->escape($data['foto']);
        $name=$this->db->escape($data['name']);
        $required_name=$this->db->escape($data['required_name']);
        $form_name=$this->db->escape($data['form_name']);
        $form_name_placeholder=$this->db->escape($data['form_name_placeholder']);
        $validateName=$this->db->escape($data['validateName']);
        $tell=$this->db->escape($data['tell']);
        $required_tell=$this->db->escape($data['required_tell']);
        $form_tell=$this->db->escape($data['form_tell']);
        $form_tell_placeholder=$this->db->escape($data['form_tell_placeholder']);
        $validateTell=$this->db->escape($data['validateTell']);
        $email=$this->db->escape($data['email']);
        $required_email=$this->db->escape($data['required_email']);
        $form_email=$this->db->escape($data['form_email']);
        $form_email_placeholder=$this->db->escape($data['form_email_placeholder']);
        $validateEmail=$this->db->escape($data['validateEmail']);

        $sql = "INSERT INTO `ldform`.`form_mark`
(`id_form_mark`, `mycolor`, `title`, `preambula`, `button`, `success`, `foto_text`, `foto`, `name`, `required_name`,
`form_name`, `form_name_placeholder`, `validateName`, `tell`, `required_tell`, `form_tell`, `form_tell_placeholder`,
 `validateTell`, `email`, `required_email`, `form_email`, `form_email_placeholder`, `validateEmail`, `id_user`)
 VALUES (NULL, '{$mycolor}', '{$title}', '{$preambula}', '{$button}', '{$success}', '{$foto_text}', '{$foto}', '{$name}',
 '{$required_name}', '{$form_name}', '{$form_name_placeholder}',
  '{$validateName}', '{$tell}', '{$required_tell}', '{$form_tell}', '{$form_tell_placeholder}', '{$validateTell}',
   '{$email}', '{$required_email}', '{$form_email}', '{$form_email_placeholder}', '{$validateEmail}','{$user_id}');";

        return $this->db->query($sql);
    }

    public function  getProgectById($id_progect){
        $id_progect = $this->db->escape($id_progect);
        $sql = "SELECT  id_progect,`progect_name` ,  `progect_site` ,  `time_mark` ,  `form_mark` ,  `id_user`
                FROM  `project` WHERE id_progect =  '{$id_progect}'";
        return $this->db->query($sql);
    }

    public function  getForm_markById($id_form_mark){
        $id_form_mark = $this->db->escape($id_form_mark);
        $sql = "SELECT  `mycolor` ,  `title` ,  `preambula` ,  `button` ,  `success` ,  `foto_text` ,  `foto` ,  `name` ,  `required_name` ,  `form_name` ,  `form_name_placeholder` ,  `validateName` ,  `tell` ,  `required_tell` ,  `form_tell` , `form_tell_placeholder` ,  `validateTell` ,  `email` ,  `required_email` ,  `form_email` ,  `form_email_placeholder` ,  `validateEmail` ,  `id_user`
                 FROM  `form_mark` WHERE id_form_mark =  '{$id_form_mark}'";
        return $this->db->query($sql);
    }
    public function  getTime_markById($id_time_mark){
        $id_time_mark = $this->db->escape($id_time_mark);
        $sql = "SELECT  `time_zone` ,  `work_day_from` ,  `work_day_until` ,  `saterday_day_from` ,  `saterday_day_until` ,  `sunday_day_from` ,  `sunday_day_until` ,  `id_user`
                FROM  `time_mark` WHERE id_time_mark =  '{$id_time_mark}'";
        return $this->db->query($sql);
    }

    public function  getProgect($id_user){
        $id_user =  $this->db->escape($id_user);
        $sql = "SELECT  `id_progect` ,  `progect_name` ,  `progect_site` FROM  `project` WHERE id_user =  '{$id_user}'";
        return $this->db->query($sql);
    }

    public function getToken($id_user){
        $id_user =  $this->db->escape($id_user);
        $sql = "SELECT `id_token`, `id_user`, `tok` FROM `token` WHERE id_user ={$id_user}";
        return $this->db->query($sql);
    }

}