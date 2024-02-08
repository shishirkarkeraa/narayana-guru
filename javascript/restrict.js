function restrictInput2(event) {
  let fieldValue = event.target.value;
  const containsSymbol = /[^\w\s]/.test(fieldValue); 
  
  if (containsSymbol) {
    document.getElementById('error').innerText = 'Symbols are not allowed';
    event.target.value = fieldValue.replace(/[^\w\s]/g, '');
  } else {
    document.getElementById('error').innerText = ''; 
  }
}

function restrictInput(event) {
  let fieldValue = event.target.value;
  const containsSymbol = /[^\w\s]|[\W_]/.test(fieldValue);
  const containsUpperCase = /[A-Z]/.test(fieldValue); 
  
  if (containsSymbol || containsUpperCase) {
    document.getElementById('error').innerText = 'Symbols or uppercase letters are not allowed';
    event.target.value = fieldValue.replace(/[^\w\s]|[\W_]|[A-Z]/g, '');
    document.getElementById('username').focus();
  } else {
    document.getElementById('error').innerText = ''; 
    document.getElementById('username').focus();
  }
}

function restrictInput3(event) {
  let fieldValue = event.target.value;
  const containsNonLetters = /[^A-Za-z ]/.test(fieldValue); 
  if (containsNonLetters) {
    document.getElementById('error').innerText = 'Error: Only letters are allowed';
    event.target.value = fieldValue.replace(/[^A-Za-z ]/g, '');
  } else {
    document.getElementById('error').innerText = '';
  }
}

function restrictInput4(event) {
  let fieldValue = event.target.value;
  const containsNonAllowed = /[^A-Za-z0-9\-#, ]/.test(fieldValue);
  
  if (containsNonAllowed) {
    document.getElementById('error').innerText = 'Only letters, numbers, -, and # are allowed';
    event.target.value = fieldValue.replace(/[^A-Za-z0-9\-#, ]/g, '');
  } else {
    document.getElementById('error').innerText = ''; 
  }
}


function restrictInput5(event) {
  let fieldValue = event.target.value;
  const containsNonNumber = /[^0-9]/.test(fieldValue); 
  
  if (fieldValue.length > 10) {
    document.getElementById('error').innerText = 'Only  10 digits are allowed';
    event.target.value = fieldValue.replace(/[^0-9]/g, '').slice(0, 10);
  }else {
    document.getElementById('error').innerText = '';
  }
  
  if(containsNonNumber){
    document.getElementById('error').innerText = 'Only numbers are allowed';
    event.target.value = fieldValue.replace(/[^0-9]/g, '');
  }
  else {
    document.getElementById('error').innerText = '';
  }
}

function restrictInput6(event) {
  let fieldValue = event.target.value;
  const containsSymbol = /[^\w\s@#]/.test(fieldValue);

  if (containsSymbol) {
    document.getElementById('error').innerText = 'Only @ and # symbols are allowed';
    event.target.value = fieldValue.replace(/[^\w\s@#]/g, ''); 
  } else {
    document.getElementById('error').innerText = '';
  }
}