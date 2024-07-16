function uploadVideo() {
    const formData = new FormData();
    const videoFile = document.getElementById('videoFile').files[0];
    formData.append('videoFile', videoFile);

    fetch('upload.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('status').innerHTML = `<div class="alert alert-info">${data}</div>`;
    })
    .catch(error => {
        console.error('Erro:', error);
        document.getElementById('status').innerHTML = `<div class="alert alert-danger">Erro: ${error}</div>`;
    });
}
