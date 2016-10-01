

  function al(data){
      alert (data);
  }
    function call() {
        var msg   = $('#formx').serialize();



        $.ajax({
            type: 'POST',
            url: 'http://ldform/ajax/ajax/setting/',
            data: msg,
            success: function(data) {
                $('#alert').html(data);


                  window.location.href = "http://ldform/users/setting/"+data+'?message=проэкт создан';

            },
            error:  function(xhr, str){
                alert('Возникла ошибка: ' + xhr.responseCode);
            }
        });
    }
  function singup() {
      var msg   = $('#formx').serialize();

      $.ajax({
          type: 'POST',
          url: 'http://ldform/ajax/ajax/singup/',
          data: msg,
          success: function(data) {
              $('#alert').html(data);
          },
          error:  function(xhr, str){
              alert('Возникла ошибка: ' + xhr.responseCode);
          }
      });
  }



    /**
     * Функция Скрывает/Показывает блок
     * @author ox2.ru дизайн студия
     **/
        function showHide(element_id) {
        //Если элемент с id-шником element_id существует
        if (document.getElementById(element_id)) {
            //Записываем ссылку на элемент в переменную obj
            var obj = document.getElementById(element_id);
            //Если css-свойство display не block, то:
            if (obj.style.display != "block") {
                obj.style.display = "block"; //Показываем элемент


            }

        }
        //Если элемент с id-шником element_id не найден, то выводим сообщение
        else alert("Элемент с id: " + element_id + " не найден!");
    }
function delay(f, ms) {

    return function() {
        var savedThis = this;
        var savedArgs = arguments;

        setTimeout(function() {
            f.apply(savedThis, savedArgs);
        }, ms);
    };

}


function hide_time(which,div_id) {
    ma=document.getElementById(div_id);

    if (which=="false") ma.style.display="block";
    else ma.style.display="none";

}

