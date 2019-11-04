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
	context.drawImage(video, 0, 0, 200, 200);
});