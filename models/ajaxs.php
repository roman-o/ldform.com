<?php

class Ajaxs extends Model
{
    public function  getByLogin($login){
        $login = $this->db->escape($login);
        $sql = "select id,login from users where login = '{$login}' limit 1";
        $result = $this->db->query($sql);
        if( isset($result[0])){
            return $result[0];
        }
        return false;
    }


    public function singUp($data,$hash){


        $login=$this->db->escape($data['login']);

        $password=$this->db->escape($hash);


        $sql="INSERT INTO users SET login='{$login}',password='{$password}'";

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

    public function  lastInsertIdByUserId($id_user,$id_table,$name_table){
        $id_user =$this->db->escape($id_user);
        $id_table =$this->db->escape($id_table);
        $name_table =$this->db->escape($name_table);
        $sql = "SELECT MAX({$id_table}) as lastId  FROM $name_table  WHERE id_user = '{$id_user}'";
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

    public function  updateProgect($data, $id_user, $id_progect){
        $id_progect =$this->db->escape($id_progect);
        $id_user =$this->db->escape($id_user);
        $progect_name=$this->db->escape($data['progect_name']);
        $progect_site=$this->db->escape($data['progect_site']);
        $sql = "UPDATE  `project` SET  `progect_name` =  '{$progect_name}', `progect_site` =  '{$progect_site}' WHERE id_progect =  '{$id_progect}' AND id_user =  '{$id_user}'";
        return $this->db->query($sql);
    }

    public function  updateTimeMark($data, $id_user, $id_time_mark){
        $id_time_mark =$this->db->escape($id_time_mark);
        $id_user =$this->db->escape($id_user);
        $work_day_from=$this->db->escape($data['work_day_from']);
        $work_day_until=$this->db->escape($data['work_day_until']);
        $saterday_day_from=$this->db->escape($data['saterday_day_from']);
        $saterday_day_until=$this->db->escape($data['saterday_day_until']);
        $sunday_day_from=$this->db->escape($data['sunday_day_from']);
        $sunday_day_until=$this->db->escape($data['sunday_day_until']);
        $time_zone=$this->db->escape($data['time_zone']);

        $sql = "UPDATE  `time_mark` SET  `time_zone` =  '{$time_zone}',`work_day_from` =  '{$work_day_from}',`work_day_until` =  '{$work_day_until}',
                `saterday_day_from` =  '{$saterday_day_from}', `saterday_day_until` =  '{$saterday_day_until}',`sunday_day_from` =  '{$sunday_day_from}',
                `sunday_day_until` =  '{$sunday_day_until}' WHERE id_user =  '{$id_user}' AND id_time_mark =  '{$id_time_mark}'; ";
        return $this->db->query($sql);
    }

    public  function updateFormMark($data, $id_user, $id_form_mark){
        $id_user =$this->db->escape($id_user);
        $id_form_mark =$this->db->escape($id_form_mark);
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

        $sql = "UPDATE `form_mark` SET `mycolor`='{$mycolor}',`title`='{$title}',`preambula`='{$preambula}',
               `button`='{$button}',`success`='{$success}',`foto_text`='{$foto_text}',`foto`='{$foto}',
               `name`='{$name}',`required_name`='{$required_name}',`form_name`='{$form_name}',
               `form_name_placeholder`='{$form_name_placeholder}',`validateName`='{$validateName}',`tell`='{$tell}',
               `required_tell`='{$required_tell}',`form_tell`='{$form_tell}',`form_tell_placeholder`='{$form_tell_placeholder}',
               `validateTell`='{$validateTell}',`email`='{$email}',`required_email`='{$required_email}',`form_email`='{$form_email}',
               `form_email_placeholder`='{$form_email_placeholder}',`validateEmail`='{$validateEmail}'
                WHERE id_form_mark ='{$id_form_mark}' and id_user ='{$id_user}'";
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

    public function getToken($id_user){
        $id_user = $login=$this->db->escape($id_user);

        $sql="UPDATE `token` SET `id_user`='{$id_user}' WHERE id_user='0' LIMIT 1";
        return $this->db->query($sql);
    }

    public  function  createSentProfile($data,$id_user){
        $id_user = $login=$this->db->escape($id_user);
        $type=$this->db->escape($data['type']);
        $profile_name=$this->db->escape($data['profile_name']);
        $sql="INSERT INTO `sent_profile`(  `id_user`, `mes_profile_name`, `type`) VALUES ('{$id_user}','{$profile_name}','{$type}')";
        

        return $this->db->query($sql);

    }

}