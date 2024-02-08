function limitCharacters(input, maxLength) {
    var currentValue = input.value;
    if (currentValue.length > maxLength) {
        input.value = currentValue.slice(0, maxLength);
    }
    let alphabeticValue = input.value.replace(/[^a-zA-Z]/g, '');
    input.value = alphabeticValue.slice(0, maxLength);
     
}

function allowNumbersOnly(input,maxLength) {
    let numericValue = input.value.replace(/[^0-9]/g, '');
    input.value = numericValue.slice(0, maxLength);
}

function allowAlphanumericWithSymbols(input, maxLength) {
    let alphanumericValue = input.value.replace(/[^a-zA-Z0-9#\/\-]/g, '');
    input.value = alphanumericValue.slice(0, maxLength);
}

function allowAlphabetsOnly(input, maxLength) {
    let alphabeticValue = input.value.replace(/[^a-zA-Z]/g, '');
    input.value = alphabeticValue.slice(0, maxLength);
}

function allowEmailFormat(input, maxLength) {
    let emailValue = input.value.replace(/[^a-zA-Z0-9@.]/g, '');
    input.value = emailValue.slice(0, maxLength);
}

function allowNumbersOnly(input, maxLength) {
    let numericValue = input.value.replace(/[^0-9]/g, '');
    input.value = numericValue.slice(0, maxLength);
}
