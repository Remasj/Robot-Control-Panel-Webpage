function sendAction(action) {
    fetch('http://localhost/BACKEND/databse.php') //initiated fetch request
    .then(response => { //checking if response in successful
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json(); //parses response body as JSON 
    })
    .then(data => { //handles JSON data from backend
        console.log('API Response:', data);
        // Handle data 
    })
    .catch(error => {
        console.error('Fetch Error:', error);
        // Handle error 
        alert('Error fetching data from backend');
    });
}