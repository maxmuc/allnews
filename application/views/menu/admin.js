$(function() {
    $( "#sortable" ).sortable({
        placeholder: "ui-state-highlight",
        update: function(){
            var arr = new Array();

            $(this).children('li').each(function(){
                var attr = $(this).attr('dataId');
                arr.push(attr);
            });

            $.ajax({
                type: 'post',
                url:  '/menu/itemSort',
                data: {'arr': arr},
            });
        }
    });
    $( "#sortable" ).disableSelection();
});

$(document).ready(function(){

    //при открытии модального окна "Создание меню", убираем значения
    $('#buttonOpenModalMenu').click(function(){
        $('#buttonDeleteMenu').css('display', 'none');
        $('#nameMenu').val('');
        $('#nameMenu').attr('menuId', '');
    });

    //кнопка "Создание меню"
    $('#menuModal #save').on('click', function(){

        var nameMenu = $('#nameMenu').val();
        var id = $('#nameMenu').attr('menuId');

        try {
            if (nameMenu == '')
                throw new Error('не должно быть пустое значение');

            $.ajax({
                url: '/menu/createMenu',
                type:     'post',
                data:     {'nameMenu': nameMenu, 'id': id},
                dataType: 'json',
                success:  function(data){
                    $('#nameMenu').val('');
                    $('#nameMenu').next('.text-danger').text('');
                    $('#menuSelect select').html('');
                    for(var tt in data)
                        $('#menuSelect select').append('<option value="'+data[tt].id+'">'+data[tt].name+'</option>');
                }
            });
            console.clear();
        }catch(e){
            $('#nameMenu').next('.text-danger').text(e.message);
            return false;
        }
    });

    //Изменить название меню
    $('#menuSelect select').on('dblclick', function(){
        var id   = $('#menuSelect select :selected').val();
        var nameMenu = $('#menuSelect select :selected').text();
        $('#buttonDeleteMenu').css('display', 'block');
        $('#nameMenu').val($.trim(nameMenu));
        $('#nameMenu').attr('menuId', $.trim(id));
        $('#menuModal .text-danger').text('');

        $('#menuModal').modal('show');
    });

    //удаление ячейки - меню
    $('#buttonDeleteMenu').on('click', function(){
        var id = $('#nameMenu').attr('menuId');
        var items = $('#sortable').text();
        if(items == ''){
            $.ajax({
                url:      '/menu/deleteMenu',
                type:     'post',
                data:     {'id': id},
                dataType: 'json',
                success:  function(data){
                    $('#menuSelect select').html('');
                    for(var tt in data)
                        $('#menuSelect select').append('<option value="'+data[tt].id+'">'+data[tt].name+'</option>');
                }
            });
            console.clear();
        }else{
            $('#menuModal .text-danger').text('Сначала нужно удалить все пункты данного меню');
            return false;
        }
    });

    //выбор меню
    $('#menuSelect select').click(function(){
        $.ajax({
            type: 'post',
            url:  '/menu/menuSelect',
            data: {'id': $('#menuSelect select :selected').val()},
            dataType: 'json',
            success: function(data){
                $('#sortable').html('');
                for(var tt in data){
                    $('#sortable').append('<li class="ui-state-default" dataId="'+data[tt].id+'" dataUrl="'+data[tt].url+'" dataStatic="'+data[tt].static+'">'+data[tt].name+'</li>');
                }
            }
        });
        //console.clear();
        return false;
    });

    /***********************работа с пунктами**************************/

    //при открытии модального окна "Создание пунтка", проверям выбрано ли меню
    $('#buttonOpenModalItem').click(function(){
        var idMenu = $('#menuSelect select :selected').val();
        if(idMenu){
            $('#nameItem, #url, .checkbox').css('display', 'block');
            $('#itemModal .text-danger').text('');
        }else{
            $('#nameItem, #url, .checkbox').css('display', 'none');
            $('#itemModal .text-danger').text('Сначала нужно выбрать "меню"');
        }
    });

    //кнопка "Создание пункта"
    $('#itemModal #save').on('click', function(){

        var idMenu   = $('#menuSelect select :selected').val();
        var nameItem = $('#nameItem').val();
        var id       = $('#nameItem').attr('itemId');
        var url      = $('#itemModal #url').val();

        if($("#itemModal input:checkbox").prop("checked"))
            var static = 1;
        else
            var static = 0;

        try {
            if (nameItem == '')
                throw new Error('не должно быть пустое значение');

            $.ajax({
                url: '/menu/createItem',
                type:     'post',
                data:     {'nameItem': nameItem, 'id': id, 'idMenu': idMenu, 'static': static, 'url': url},
                dataType: 'json',
                success:  function(data){
                    $('#itemModal').modal('hide');
                    $('#nameItem').val('');
                    $('#nameItem').next('.text-danger').text('');
                    $('#sortable').html('');
                    for(var tt in data)
                        $('#sortable').append('<li dataId="'+data[tt].id+'" dataUrl="'+data[tt].url+'" dataStatic="'+data[tt].static+'" class="ui-state-default">'+data[tt].name+'</li>');
                }
            });
            console.clear();
        }catch(e){
            $('#nameItem').next('.text-danger').text(e.message);
            return false;
        }
    });

    //Изменить параметры пункта
    $(document).on('dblclick', '#sortable li', function(){
        var id       = $(this).attr('dataId');
        var url      = $(this).attr('dataUrl');
        var nameItem = $(this).text();
        var idMenu   = $('#menuSelect select :selected').val();

        $('#buttonDeleteItem').css('display', 'block');
        $('#nameItem').attr('itemId', $.trim(id));
        $('#nameItem').attr('menuId', $.trim(idMenu));
        $('#nameItem').val($.trim(nameItem));
        $('#url').val($.trim(url));

        if($(this).attr('dataStatic') == '1'){
            $('#itemModal input:checkbox').attr('checked', 'checked');
            $('#itemModal input:checkbox').val(1);
        }else{
            $('#itemModal input:checkbox').removeAttr('checked');
            $('#itemModal input:checkbox').val(0);
        }

        $('#itemModal').modal('show');
    });

    //удаление ячейки - меню
    $('#buttonDeleteItem').on('click', function(){
        var id     = $('#nameItem').attr('itemId');
        var idMenu = $('#nameItem').attr('menuId');

        $.ajax({
            url:      '/menu/deleteItem',
            type:     'post',
            data:     {'id': id, 'idMenu': idMenu},
            dataType: 'json',
            success:  function(data){
                $('#sortable').html('');
                for(var tt in data)
                    $('#sortable').append('<li dataId="'+data[tt].id+'" dataUrl="'+data[tt].url+'" dataStatic="'+data[tt].static+'" class="ui-state-default">'+data[tt].name+'</li>');
            }
        });
        console.clear();
    });

});
