// JavaScript Document

$(function(){
		   	$("#questions").submit(function(evtObj){
				evtObj.preventDefault();
				
				var form = $(this);
				var log = function(msg){
						console.log ? console.log(msg) : alert(msg);
					}
				$.ajax({
					   	url 		: form.attr("action"),
						async 		: false,
//						complete	: function(){log("Zapros tugadi") ;},
						type		: 'POST',
						data 		: form.serialize(),
//						data		: {username:"Murod", mail:"Murod@mail.ru",msgbody:"Murod"},
						processData	: false,
						contentType	: 'application/x-www-form-urlencoded',
						dataType	: 'json'
					   });
//				log('***');
			});
		   });