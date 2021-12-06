
  var pwd = document.getElementById('pwd');
  var cpwd = document.getElementById('cpwd');
  var spwd = document.getElementById('spwd');

 function toggle()
 {
 if(pwd.type === "password"){
  pwd.type = "text";
    document.getElementById('hide').style.display = "block";
    document.getElementById('show').style.display = "none";
 }
 else{
  pwd.type = "password";
    document.getElementById('show').style.display = "block";
    document.getElementById('hide').style.display = "none";
 } 
}

function toggle1()
{
  if(spwd.type === "password"){
  spwd.type = "text";
    document.getElementById('hide1').style.display = "block";
    document.getElementById('show1').style.display = "none";
 }
 else{
  spwd.type = "password";
    document.getElementById('show1').style.display = "block";
    document.getElementById('hide1').style.display = "none";
 }
}



 function togglle() {
        if(cpwd.type === "password"){
  cpwd.type = "text";
    document.getElementById('hide1').style.display = "block";
    document.getElementById('show1').style.display = "none";
 }
 else{
  cpwd.type = "password";
    document.getElementById('show1').style.display = "block";
    document.getElementById('hide1').style.display = "none";
 }
 }