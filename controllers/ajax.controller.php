<?php
class AjaxController extends Controller{
    public  function  __construct( $data = array())
    {
        parent::__construct($data);
        $this->model= new ajaxs();
    }

    public function  ajax_setting(){

        $user =   $this->model->getByLogin(Session::get('login'));  // добываем user id
        // echo $user['id'];
        if($_POST) {

            // $lastIdProgect = $this->model->lastInsertProgectIdByUserId( $user['id']);
            // print_r($lastIdProgect[0]['lastIdProgect']);
            // print_r($_POST);
            // работаем с робочими часами
            if($_POST['time_set'] == 'true'){
                $_POST['work_day_from']= '00:00:00';
                $_POST['work_day_until'] = '00:00:00';
                $_POST['saterday_day_from'] = '00:00:00';
                $_POST['saterday_day_until'] = '00:00:00';
                $_POST['sunday_day_from'] = '00:00:00';
                $_POST['sunday_day_until'] = '00:00:00';
            }
            else {
                if ($_POST['saterday_day'] == 'false') {
                    $_POST['saterday_day_from'] = '00:01:00';
                    $_POST['saterday_day_until'] = '00:01:00';
                }
                if ($_POST['sunday_day'] == 'false') {
                    $_POST['sunday_day_from'] = '00:01:00';
                    $_POST['sunday_day_until'] = '00:01:00';
                }
            }
            if(!$this->params[0] AND !$this->params[1] AND !$this->params[2]) {
                $this->model->createTimeMark($_POST, $user['id']); // создаем time_mark
                $lastInsertIdTimeMark = $this->model->lastInsertIdByUserId($user['id'], 'id_time_mark', 'time_mark');//возвращаем id

                // создаем внешний вид
                $this->model->createFormMark($_POST, $user['id']);
                $lastInsertIdFormMark = $this->model->lastInsertIdByUserId($user['id'], 'id_form_mark', 'form_mark');//возвращаем id
                // print_r($lastInsertIdFormMark);
                $this->model->createProgect($_POST, $user['id'], $lastInsertIdTimeMark[0]['lastId'], $lastInsertIdFormMark[0]['lastId']); // создаем проэкт в базе
                $lastInsertIdProgect = $this->model->lastInsertIdByUserId($user['id'], 'id_progect', 'project');//возвращаем id
               // print_r($lastInsertIdProgect[0]['lastId']);
                echo $lastInsertIdProgect[0]['lastId'].'/'.$lastInsertIdTimeMark[0]['lastId'].'/'.$lastInsertIdFormMark[0]['lastId'];
            }
            else{
                $this->model->updateProgect($_POST,$user['id'],$this->params[0]);
                $this->model->updateTimeMark($_POST,$user['id'],$this->params[1]);
                $this->model->updateFormMark($_POST,$user['id'],$this->params[2]);
            }
           //print_r($_POST);
        }
    }

   public function ajax_singup(){
       $hash= md5(Config::get('salt').$_POST['password']);

       $verifLogin = $this->model->getByLogin($_POST['login']);
       if ($_POST['password'] !== $_POST['RepPassword']){
           echo 'пароли не совпадают';
       }
       elseif (!$_POST['login']){
           echo 'введите email';
       }
       elseif (!$_POST['password']){
           echo 'введите пароль';
       }

       elseif ($verifLogin['login'] == $_POST['login']){
           echo 'emil занят, попробуйте другой';
       }
       elseif (!filter_var($_POST['login'], FILTER_VALIDATE_EMAIL)) {
           echo "E-mail  указан неверно.";
       }else {
           if ($this->model->singUp($_POST, $hash)){
               echo 'регистрация прошла успешно';
          //    echo '<script language="JavaScript" type="text/javascript"> function GoNah(data){ location=data;}
           //           setTimeout( \'GoNah("http://ldform/users/setting")\', 3000 );</script>';
               Session::set('login', $_POST['login']);
               Session::set('role', 'admin');
               $user = $this->model->userProfile($_POST['login']);
               $this->model->getToken($user[0]['id']);
           }
           }
   }

    public  function  ajax_sent_profile(){
       print_r($_POST);
        $user =   $this->model->getByLogin(Session::get('login'));
        print_r($user['id']);
        $this->model->createSentProfile($_POST,$user['id']);

    }
}