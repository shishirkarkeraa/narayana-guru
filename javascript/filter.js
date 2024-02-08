function filterData(option) {
    fetch(`filter.php?option=${option}`)
        .then(response => response.text())
        .then(data => {
            document.getElementById('membershipTable').innerHTML = data;
        })
        .catch(error => console.error('Error fetching data:', error));
}

window.addEventListener('DOMContentLoaded', (event) => {
    const filterButton = document.getElementById('filter1');
    if (filterButton) {
        filterButton.click();
    } else {
        console.error("Button not found!");
    }
});