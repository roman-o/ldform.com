<?php

class UsersController extends  Controller{
    public  function  __construct($data = array())
    {
        parent::__construct($data);
        $this->model = new  User();

    }
    public  function index(){
        echo "hello index user page";
    }
    public function login(){
   if( $_POST && isset($_POST['login']) && isset($_POST['password'])){
       $user = $this->model->getByLogin($_POST['login']);
       $hash= md5(Config::get('salt').$_POST['password']);
       if($user && $user['is_active'] && $hash == $user['password'] ){
           Session::set('login', $user['login']);
           Session::set('role', $user['role']);
       }
       Router::redirect('/users');
   }
    }

    public function  singup(){


            $hash= md5(Config::get('salt').$_POST['password']);
            $verifLogin = $this->model->getByLogin($_POST['login']);



          if($_POST) {
              if ($verifLogin['login'] == $_POST['login']) {

                  Session::setFlash('Enather  login or email ');
              } else {
                  $this->model->singUp($_POST, $hash);
                  Session::setFlash('Thank you! Your message was
                  sent successful ');
                  Session::set('login', $_POST['login']);
                  Session::set('role', 'admin');
                 // Router::redirect('/users/setting');
              }
          }
    }



    public function logout(){
        Session::destroy('/admin');
        Router::redirect('/users');
    }


    public  function  profile(){

        $login = Session::get('login');

        $this->data = $this->model->userProfile($login);

        $params = App::getRouter()->getParams();
        print_r($params);
    }

    public function setting()
    {
        $id_progect =  $this->params[0];
       // echo $id_progect;
        $user = $this->model->getByLogin(Session::get('login'));  // добываем user id
       // echo $user['id'];
        $this->data['progect'] = $this->model->getProgectById($id_progect);
       // print_r($this->data);
        $id_form_mark = $this->data['progect'][0]['form_mark'];
       // echo $id_form_mark;
        $this->data['form_mark'] = $this->model->getForm_markById($id_form_mark);

        $id_time_mark = $this->data['progect'][0]['time_mark'];
        $this->data['time_mark'] = $this->model->getTime_markById($id_time_mark);
      //  print_r($this->data);

        $this->data['token']= $this->model->getToken($user['id']);
       // echo  $this->data['token'][0]['tok'];



    }

    public  function project_list(){
        $user = $this->model->getByLogin(Session::get('login'));
       $this->data = $this->model->getProgect($user['id']);
        print_r($this->data);
    }

    public  function  sent_profile(){

    }


}