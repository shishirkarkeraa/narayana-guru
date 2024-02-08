function handleStatusChange() {
    const status = document.getElementById('status').value;
    const expiryDateDiv = document.getElementById('expiryDateDiv');
  
    if (status === 'yearly') {
      expiryDateDiv.style.display = 'block';
    } else {
      expiryDateDiv.style.display = 'none';
    }
  }

function updateExpiryDate() {
    const joinDateField = document.getElementById('joinDate');
    const expiryDateField = document.getElementById('expiryDate');

    const joinDate = new Date(joinDateField.value);
    if (!isNaN(joinDate.getTime())) {
        joinDate.setFullYear(joinDate.getFullYear() + 1);

        const formattedExpiryDate =
        ('0' + joinDate.getDate()).slice(-2) +'-' +('0' + (joinDate.getMonth() + 1)).slice(-2) +'-' +joinDate.getFullYear();
        expiryDateField.value = formattedExpiryDate;
    } else {
        expiryDateField.value = '';
    }
}