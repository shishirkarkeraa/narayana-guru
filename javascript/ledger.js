document.addEventListener('DOMContentLoaded', function() {
    var transactionType = document.querySelector('input[name="transactionType"]:checked').value;
    showHideReasons(transactionType);
});

function showHideReasons(transactionType) {
    var reasons = document.getElementById("reason").getElementsByTagName("option");
    for (var i = 0; i < reasons.length; i++) {
        var reasonValue = reasons[i].value;
        if (
            (transactionType === 'income' && parseInt(reasonValue.replace('option', '')) > 13) ||
            (transactionType === 'expenditure' && parseInt(reasonValue.replace('option', '')) <= 13)
        ) {
            reasons[i].style.display = 'none';
        } else {
            reasons[i].style.display = 'block';
        }
    }
  }
  
  var radioButtons = document.querySelectorAll('input[name="transactionType"]');
        radioButtons.forEach(function(radioButton) {
            radioButton.addEventListener('change', function() {
                showHideReasons(this.value);
                clearReasonsField();
            });
        });

  function validateForm() {
    var reason = document.getElementById("reason").value;
    var errorDiv = document.getElementById("error");
    if (reason === "") {
        errorDiv.innerText = "Please select a reason.";
        return false; 
    }
    errorDiv.innerText = "";
    return true;
}

function clearReasonsField() {
    document.getElementById('reason').value = 'none';
}