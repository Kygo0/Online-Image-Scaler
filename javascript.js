imgInp.onchange = evt => {
	const [file] = imgInp.files
	if (file) {
		imageID.src = URL.createObjectURL(file)
	}
}

function changeStyle() {
    var element = document.getElementById("imageID");
    var widthElement = document.getElementById("userWidth").value;
    var heightElement = document.getElementById("userHeight").value;
    if (widthElement > 650) {
        widthElement = 650;
    }
    if (heightElement > 650) {
        heightElement = 650;
    }
    element.style.width = widthElement + "px";
    element.style.height = heightElement + "px";
}