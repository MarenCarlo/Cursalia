  var textarea = document.getElementById('text__area');
  var length = textarea.getAttribute("maxlength");
  var cuenta = document.getElementById('count');
  cuenta.innerHTML = length;
  textarea.onkeydown = function () {
    document.getElementById('count').innerHTML = (length - this.value.length);
  };
/*
  var textarea = document.getElementsByName('AddDescript');
  var length = textarea.getAttribute("maxlength");
  var cuenta = document.getElementByName('contador');
  cuenta.innerHTML = length;
  textarea.onkeydown = function () {
    document.getElementByName('contador').innerHTML = (length - this.value.length);
  };
*/