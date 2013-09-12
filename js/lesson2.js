// JavaScript Document

$(function(){
		   	$("#send-msg-form").submit(function(evtObj){
				evtObj.preventDefault();
				
				var form = $(this);
                
				$.ajax({
					   	url 		: form.attr("action"),
						async 		: false,
//						complete	: function(){log("Zapros tugadi") ;},
						type		: 'POST',
						data 		: form.serialize(),
//						data		: {username:"Murod", mail:"Murod@mail.ru",msgbody:"Murod"},
//						processData	: false,                        
						contentType	: 'application/x-www-form-urlencoded',
                        dataType	: 'json',
                        success     : function(data, textStatus, xhr){
                            if(data.success == '1')
                                log("xabar yuborildi");
                            else if(data.error == '1')
                                log("Xabar yuborilmadi. Sababi: "+data.notification);
                        },
                        error       : function(xht, textStatus, errorObj){
                            log('Xatolik bo`ldi');
                            log(textStatus);
                            log(errorObj.message);
                        },						
                        dataFilter  : function(data, dataType){return data;}
					   });
                       });
//				log('***');
				$.ajaxSetup({
							beforeSend 	: function(xhr){$("#load-indicator").show();},
							complete	: function(xhr, textStatus){$("#load-indicator").hide();}
							})
			});
		   });