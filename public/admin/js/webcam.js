document.addEventListener("DOMContentLoaded", function () {
  const video = document.getElementById("webcam");
  const canvas = document.getElementById("canvas");
  const image = document.getElementById("image");
  const captureButton = document.getElementById("capture");

  navigator.mediaDevices
    .getUserMedia({ video: true })
    .then((stream) => {
      video.srcObject = stream;
    })
    .catch((error) => {
      console.error("Error accessing webcam: ", error);
    });

  captureButton.addEventListener("click", function () {
    const context = canvas.getContext("2d");
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    context.drawImage(video, 0, 0, canvas.width, canvas.height);

    image.src = canvas.toDataURL("image/jpeg");
    image.style.display = "block";

    // Setelah gambar diterima melalui AJAX
    $.ajax({
      type: "POST",
      url: "/webcam/save_image",
      data: { image_data: image.src },
      success: function (response) {
        // URL gambar yang diterima dari server
        var imageUrl = response.image_url; // Gantilah dengan URL gambar yang sesuai

        // Simpan URL gambar dalam elemen tersembunyi
        $("#imageURL").val(imageUrl);
      },
      error: function (error) {
        console.error("Error sending image: ", error);
      },
    });
  });
});
