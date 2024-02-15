toggleFields();
updateExpiryDate();



function toggleFields() {
    var updateType = document.getElementById('updateType').value;
    var lifeStatus = document.getElementById('lifeStatus');
    var membership = document.getElementById('membership');
    var upname = document.getElementById('upname');
    var upaddress = document.getElementById('upaddress');
    var upjoinDate = document.getElementById('upjoinDate');
    var expiryDate = document.getElementById('expiryDate');
    var photo = document.getElementById('photo');

    if (lifeStatus) lifeStatus.style.display = 'none';
    if (membership) membership.style.display = 'none';
    if (upname) upname.style.display = 'none';
    if (upaddress) upaddress.style.display = 'none';
    if (upjoinDate) upjoinDate.style.display = 'none';
    if (expiryDate) expiryDate.style.display = 'none';
    if (photo) photo.style.display = 'none';
    if (document.getElementById(updateType)==photo){
        photo.style.display = 'block';
    }

    if (document.getElementById(updateType)==lifeStatus) {
        document.getElementById(updateType).style.display = 'flex';
    }        
    else if (document.getElementById(updateType)) {
        document.getElementById(updateType).style.display = 'block';
    }
    
}




function updateExpiryDate() {
    const joinDateField = document.getElementById('upjoinDate');
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

function handleStatusChange() {
    const status = document.getElementById('membership').value;
    const expiryDateDiv = document.getElementById('expiryDate');
  
    if (status === 'yearly') {
      expiryDateDiv.style.display = 'block';
      
    } else {
      expiryDateDiv.style.display = 'none';
    }
  }

function executeFunction() {
    const join = document.getElementById('upjoinDate');
    const expire = document.getElementById('expiryDate');
    join.style.display = 'block';
    expire.style.display = 'block';
  }
  

document.getElementById('updateType').addEventListener('change', function() {
    let selectedOption = this.value;

    if (selectedOption === 'membership') {
      executeFunction();
    }
  });

