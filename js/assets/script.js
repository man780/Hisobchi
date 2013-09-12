// JavaScript Document
	$(function(){
	     
	    var questions = $('#questions');
	     
	    function refreshSelects(){
	        var selects = questions.find('select');
	         
	        // Улучшаем элемент selects с помощью плагина Chose
	        selects.chosen();
	         
	        // Ждем изменений
	        selects.unbind('change').bind('change',function(){
	             
	            // Выбранная опция
	            var selected = $(this).find('option').eq(this.selectedIndex);
	            // Ищем атрибут data-connection
	            var connection = selected.data('connection');
	             
	             
	            // Удаляем следующий контейнер li (к=если есть)
	            selected.closest('#questions li').nextAll().remove();
	             
	            if(connection){
	                fetchSelect(connection);
	            }
	 
	        });
	    }
	     
	    var working = false;
	      
	    function fetchSelect(val){
	         
	        if(working){
	            return false;
	        }
	        working = true;
	         
	        $.getJSON('ajax.php',{key:val},function(r){
	             
	            var connection, options = '';
	             
	            $.each(r.items,function(k,v){
	                connection = '';
	                if(v){
	                    connection = 'data-connection="'+v+'"';
	                }
	                 
	                options+= '<option value="'+k+'" '+connection+'>'+k+'</option>';
	            });
	             
	            if(r.defaultText){
	                 
	                // Плагин Chose требует, чтобы был добавлен пустой элемент опции
	                // если нужно выводить текст "Пожалуйста, выберите"
	                 
	                options = '<option></option>'+options;
	            }
	             
	            // Строим разметку для раздела select
	             
	            $('<li>\
	                <p>'+r.title+'</p>\
	                <select data-placeholder="'+r.defaultText+'">\
	                    '+ options +'\
	                </select>\
	                <span class="divider"></span>\
	            </li>').appendTo(questions);
	             
	            refreshSelects();
	             
	            working = false;
	        });
	         
	    }
	     
	    $('#preloader').ajaxStart(function(){
	        $(this).show();
	    }).ajaxStop(function(){
	        $(this).hide();
	    });
	     
	    // В начале загружаем выбор продукта
	    fetchSelect('productSelect');
	});
