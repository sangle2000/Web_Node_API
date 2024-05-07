// Fetch user's full name and insert into the placeholder
fetch('get_user_info.php')
.then(response => response.text())
.then(data => {
    document.getElementById('userFullNamePlaceholder').textContent = data;
})
.catch(error => console.error('Error fetching user full name:', error));