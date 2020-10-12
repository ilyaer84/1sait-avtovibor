// JavaScript Document

function div_hide(id) {
		x=document.getElementById(id);
		if (x.style.display == 'block') {
		
		//document.getElementById(id).innerHTML='function div_hide!'; //document.getElementById('xx').style.display = 'none'; 
			x.style.display = 'none';
			
			console.log('x.style.display: ' + x);

		} else {
			x.style.display = 'block';
			console.log('x.style.display: ' + x);
		}
	}

//document.getElementById('close').onclick = hide; // hide - ф-я написанная выше


window.onload = function() { //  window.onload только один
	
}