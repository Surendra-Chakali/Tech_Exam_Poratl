
var pwd = document.querySelector('#pwd');
var cpwd = document.querySelector('#cpwd');
var submit = document.querySelector('#submit');
var rollnum = document.querySelector('#rollnum');
var regularExpression  = /^(?=.*[0-9])(?=.*[!@#$&*])[a-zA-Z0-9!@#$&*]{8,}$/;


submit.disabled = true;

var passworderror = document.querySelector('.passerror');
var pwd_match = document.querySelector('.pwd_match');


pwd.addEventListener('keyup', function(){
	if(!regularExpression.test(pwd.value)){
		pwd.style.borderBottom = '2px solid red';
		passworderror.style.display = 'block';
	}else{pwd.style.borderBottom = '1px solid green';passworderror.style.display = 'none';}
});

cpwd.addEventListener('keyup', function(){
		if(pwd.value != cpwd.value){pwd_match.style.display = 'block';cpwd.style.borderBottom = '1px solid red';}
		else{pwd_match.style.display = 'none';cpwd.style.borderBottom = '1px solid green';submit.disabled = false;}
});

rollnum.addEventListener('keyup', function(){
	if(rollnum.value.length < 10){rollnum.style.borderBottom = '1px solid red';}
	else{rollnum.style.borderBottom = '1px solid green';}
});

