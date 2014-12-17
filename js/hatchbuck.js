 var jsTime = setInterval(function(){try{JotForm.jsForm = true;
		JotForm.init(function(){$('input_4').hint('ex: myname@example.com');JotForm.highlightInputs = false;});
		clearInterval(jsTime); }catch(e){}}, 1000);