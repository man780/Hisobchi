// JavaScript Document
	$(function(){
	     
	    var questions = $('#questions');
	     
	    function refreshSelects(){
	        var selects = questions.find('select');
	         
	        // �������� ������� selects � ������� ������� Chose
	        selects.chosen();
	         
	        // ���� ���������
	        selects.unbind('change').bind('change',function(){
	             
	            // ��������� �����
	            var selected = $(this).find('option').eq(this.selectedIndex);
	            // ���� ������� data-connection
	            var connection = selected.data('connection');
	             
	             
	            // ������� ��������� ��������� li (�=���� ����)
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
	                 
	                // ������ Chose �������, ����� ��� �������� ������ ������� �����
	                // ���� ����� �������� ����� "����������, ��������"
	                 
	                options = '<option></option>'+options;
	            }
	             
	            // ������ �������� ��� ������� select
	             
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
	     
	    // � ������ ��������� ����� ��������
	    fetchSelect('productSelect');
	});
