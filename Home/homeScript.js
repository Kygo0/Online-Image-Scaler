//Resize vars
const fileInput = document.querySelector(".drop-zone__input");
const widthInput = document.querySelector(".resizer__input--width");
const heightInput = document.querySelector(".resizer__input--height");
const aspectToggle = document.querySelector(".resizer__aspect");
const canvas = document.querySelector(".resizer__canvas");
const canvasCtx = canvas.getContext("2d");
//Crop vars
let result = document.querySelector('.result'),
    img_result = document.querySelector('.img-result'),
    img_w = document.querySelector('.img-w'),
    options = document.querySelector('.options'),
    save = document.querySelector('.save'),
    cropped = document.querySelector('.cropped'),
    dwn = document.querySelector('.download'),
    upload = document.querySelector('#file-input'),
    cropper = '';

//Resize image
let activeImage, originalWidthToHeightRatio;

fileInput.addEventListener("change", (e) => {
    const reader = new FileReader();
     reader.addEventListener("load", () => {
         openImage(reader.result);
     });

    reader.readAsDataURL(e.target.files[0]);
});

// widthInput.addEventListener("change", () => {
//     if (!activeImage) return;
// 
//     const heightValue = aspectToggle.checked
//         ? widthInput.value / originalWidthToHeightRatio
//         : heightInput.value;
// 
//     resize(widthInput.value, heightValue);
// });
// 
// heightInput.addEventListener("change", () => {
//     if (!activeImage) return;
// 
//     const widthValue = aspectToggle.checked
//         ? heightInput.value * originalWidthToHeightRatio
//         : widthInput.value;
// 
//     resize(widthValue, heightInput.value);
// });

//function openImage(imageSrc) {
//    activeImage = new Image();
//
//    activeImage.addEventListener("load", () => {
//        originalWidthToHeightRatio = activeImage.width / activeImage.height;
//
//        resize(activeImage.width, activeImage.height);
//    });
//
//    activeImage.src = imageSrc;
//}

function resize(width, height) {
    canvas.width = Math.floor(width);
    canvas.height = Math.floor(height);
    widthInput.value = Math.floor(width);
    heightInput.value = Math.floor(height);

    canvasCtx.drawImage(activeImage, 0, 0, Math.floor(width), Math.floor(height));
}

document.querySelectorAll(".drop-zone__input").forEach((inputElement) => {
    const dropZoneElement = inputElement.closest(".drop-zone");

    dropZoneElement.addEventListener("click", (e) => {
        inputElement.click();
    });

    inputElement.addEventListener("change", (e) => {
        if (inputElement.files.length) {
            updateThumbnail(dropZoneElement, inputElement.files[0]);
        }
    });

    dropZoneElement.addEventListener("dragover", (e) => {
        e.preventDefault();
        dropZoneElement.classList.add("drop-zone--over");
    });

    ["dragleave", "dragend"].forEach((type) => {
        dropZoneElement.addEventListener(type, (e) => {
            dropZoneElement.classList.remove("drop-zone--over");
        });
    });

    dropZoneElement.addEventListener("drop", (e) => {
        e.preventDefault();
        if (e.dataTransfer.files.length) {
            inputElement.files = e.dataTransfer.files;
            updateThumbnail(dropZoneElement, e.dataTransfer.files[0]);
        }
        

        dropZoneElement.classList.remove("drop-zone--over");
    });
});

function resizeDnD(width, height) {

}
/**
 * Updates the thumbnail on a drop zone element.
 *
 * @param {HTMLElement} dropZoneElement
 * @param {File} file
 */
function updateThumbnail(dropZoneElement, file) {
    let thumbnailElement = dropZoneElement.querySelector(".drop-zone__thumb");

    // First time - remove the prompt
    if (dropZoneElement.querySelector(".drop-zone__prompt")) {
        dropZoneElement.querySelector(".drop-zone__prompt").remove();
    }

    // First time - there is no thumbnail element, so lets create it
    if (!thumbnailElement) {
        thumbnailElement = document.createElement("div");
        thumbnailElement.classList.add("drop-zone__thumb");
        dropZoneElement.appendChild(thumbnailElement);
    }

    thumbnailElement.dataset.label = file.name;

    // Show thumbnail for image files
    if (file.type.startsWith("image/")) {
        const reader = new FileReader();

        reader.readAsDataURL(file);
        reader.onload = () => {
            thumbnailElement.style.backgroundImage = `url('${reader.result}')`;
        };
    } else {
        thumbnailElement.style.backgroundImage = null;
    }
}
//Crop Image
// on change show image with crop options
upload.addEventListener('change', e => {
    if (e.target.files.length) {
        // start file reader
        const reader = new FileReader();
        reader.onload = e => {
            if (e.target.result) {
                // create new image
                let img = document.createElement('img');
                img.id = 'image';
                img.src = e.target.result;
                // clean result before
                result.innerHTML = '';
                // append new image
                result.appendChild(img);
                // show save btn and options
                save.classList.remove('hide');
                options.classList.remove('hide');
                // init cropper
                cropper = new Cropper(img);
            }
        };
        reader.readAsDataURL(e.target.files[0]);
    }
});


// save on click
 save.addEventListener('click', e => {
     e.preventDefault();
     // get result to data uri
     let imgSrc = cropper.getCroppedCanvas({
         width: img_w.value // input value img_w.value
     }).toDataURL();
 
     // remove hide class of img
     cropped.classList.remove('hide');
     img_result.classList.remove('hide');
     // show image cropped
     cropped.src = imgSrc;
     dwn.classList.remove('hide');
     dwn.download = 'imagename.png';
     dwn.setAttribute('href', imgSrc);
 });
