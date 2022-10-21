imgInp.onchange = evt => {
	const [file] = imgInp.files
	if (file) {
		imageID.src = URL.createObjectURL(file)
	}
}