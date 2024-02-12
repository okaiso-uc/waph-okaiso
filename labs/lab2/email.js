var shown = false;

function showhideEmail() {
  if (shown) {
    document.getElementById('email').textContent = "Show my email";
    shown = false;
  } else {
    var input = document.getElementById('emailInput').value;
    var encodedInput = encodeInput(input);
    if (validateEmail(encodedInput)) {
      var encodedEmail = encodeURI(encodedInput);
      var myemail = "<a href='mailto:" + encodedEmail + "'>" + encodedEmail + "</a>";
      document.getElementById('email').innerHTML = myemail;
      shown = true;
    } else {
      alert("Invalid email address!");
    }
  }
}

function encodeInput(input) {
  const encoded = document.createElement('div');
  encoded.innerText = input;
  return encoded.innerHTML;
}

function validateEmail(email) {
  const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
  return emailPattern.test(email);
}
