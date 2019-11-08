var video = document.querySelector("#video");

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
    .catch(function (err0r) {
      console.log("Something went wrong!");
    });
}
//view image .. canvas tag
var context = canvas.getContext('2d');
snap.addEventListener("click", function() {
	context.drawImage(video, 0, 0, 450, 450);
});

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