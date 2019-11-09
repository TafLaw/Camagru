var video = document.querySelector("video");
var canvas = document.getElementById("canvas");
var context = canvas.getContext('2d');

snap.addEventListener("click", function() {
  document.getElementById('canvas').style.display = "inline";
  document.getElementById('save-btn').style.display = "inline";
});

//Add stickers
function add_sticker(sticker_src)
    {
        var imageObj = new Image();
        
        imageObj.src = sticker_src;
        context.drawImage(imageObj, 0, 0, canvas.width, canvas.height);
        document.getElementById('image').value = canvas.toDataURL('image/png');
    }   

//capture the pic
function takeSnapshot() {
  canvas.height = video.offsetHeight;
  canvas.width = video.offsetWidth;
  context.drawImage(video, 0, 0, canvas.width,canvas.height);
  document.getElementById('image').value = canvas.toDataURL('image/png');
}

const constraints = {
  video: {
    width: 450, height: 450
  }
};
//access the webcam
if (navigator.mediaDevices.getUserMedia) {
  navigator.mediaDevices.getUserMedia(constraints)
    .then(function (stream) {
      video.srcObject = stream;
    })
    .catch(function (error) {
      console.log("Something went wrong!");
      document.getElementById('snap').addEventListener("click", takeSnapshot);
    });
}
//view image .. canvas tag
//var context = canvas.getContext('2d');
/* snap.addEventListener("click", function() {
    document.getElementById('canvas').style.display = 'inline';
    document.getElementById('save-btn').style.display = "inline";
    context.drawImage(video, 0, 0, 450, 450);
    document.getElementById('image').value = canvas.toDataURL('image/png');
}); */












/* var link = document.createElement('a');
    link.innerHTML = 'download image';
link.addEventListener('click', function(ev) {
    link.href = canvas.toDataURL();
    link.download = "mypainting.png";
}, false);
document.body.appendChild(link); */

document.getElementById("download_button").onclick = function() {

  var link = document.createElement("a");
  link.download = "image.png";

  canvas.toBlob(function(blob){
    link.href = URL.createObjectURL(blob);
    console.log(blob);
    console.log(link.href);
    link.click();
  },'image/png');
}

/* var canvas=document.getElementById("canvas");
var dataUrl=canvas.toDataURL();

$.ajax({
  type: "POST",
  url: "http://localhost/saveCanvasDataUrl.php",
  data: {image: dataUrl}
})
.done(function(respond){console.log("done: "+respond);})
.fail(function(respond){console.log("fail");})
.always(function(respond){console.log("always");}) */