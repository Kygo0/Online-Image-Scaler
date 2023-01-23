// Get the form and file input elements
const form = document.getElementById('image-form');
const input = document.getElementById('image-input');

// Listen for the form's submit event
form.addEventListener('submit', async (event) => {
    event.preventDefault();

    // Use FormData to collect the file data
    const formData = new FormData();
    formData.append('image', input.files[0]);

    // Use fetch to send the file data to the server
    const response = await fetch('upload.php', {
        method: 'POST',
        body: formData
    });

    // Parse the JSON response
    const data = await response.json();

    // Display a message to the user
    const message = document.getElementById('message');
    message.innerHTML = data.message;
});