var canvas = document.getElementById('canvas');
var context = canvas.getContext('2d');
var video = document.querySelector('video');
const constraints = {
    video: {
      width: 450, height: 450
    }
  };

//add sticker to image
function add_sticker(sticker_src)
{
    var imageObj = new Image();
    
    imageObj.src = sticker_src;
    context.drawImage(imageObj, 0, 0, 450, 450);
    document.getElementById('image').value = canvas.toDataURL('image/png');
}   


//connect to the webcam
if (navigator.mediaDevices)
{
    navigator.mediaDevices.getUserMedia(constraints)
    .then(function(stream) {
        video.srcObject = stream;
        document.getElementById('snap').addEventListener("click", captureImage);
    })
    .catch(function(err) {
        alert("could not access camera " + error.name);
    });
}

//capture the image
function captureImage() {
    canvas.height = video.offsetHeight;
    canvas.width = video.offsetWidth;
    context.drawImage(video, 0, 0, canvas.width,canvas.height);
    document.getElementById('image').value = canvas.toDataURL('image/png');
}