var tutorialPicturePrevious = document.getElementById("lightbox-picture-previous");
tutorialPicturePrevious.onclick = function () {
	plusPictureIndex(-1);
}

var tutorialPictureNext = document.getElementById("lightbox-picture-next");
tutorialPictureNext.onclick = function () {
	plusPictureIndex(1);
}

var tutorialPicture1 = document.getElementsByClassName("tutorial-picture-1");
for (let i = 0; i < tutorialPicture1.length; i++) {
	tutorialPicture1[i].onclick = function () {
		lightbox.style.display = "block";
		currentPicture(1);
	}
}

var tutorialPicture2 = document.getElementsByClassName("tutorial-picture-2");
for (let i = 0; i < tutorialPicture2.length; i++) {
	tutorialPicture2[i].onclick = function () {
		lightbox.style.display = "block";
		currentPicture(2);
	}
}

var lightbox = document.getElementById("lightbox");
var close = document.getElementById("lightbox-close");
close.onclick = function () {
	lightbox.style.display = "none";
}
window.onclick = function (event) {
	if (event.target == lightbox) {
		lightbox.style.display = "none";
	}
}

var currentPictureIndex = 1;
showPicture(currentPictureIndex);

function plusPictureIndex(n) {
	showPicture(currentPictureIndex += n);
}

function currentPicture(n) {
	showPicture(currentPictureIndex = n);
}

function showPicture(n) {
	var pictures = document.getElementsByClassName("lightbox-picture");
	var lightboxPictureText = document.getElementById("lightbox-picture-text");
	if (n > pictures.length) {
		currentPictureIndex = 1
	}
	if (n < 1) {
		currentPictureIndex = pictures.length
	}
	for (i = 0; i < pictures.length; i++) {
		pictures[i].style.display = "none";
	}
	lightboxPictureText.innerHTML = currentPictureIndex + " / " + pictures.length;
	pictures[currentPictureIndex - 1].style.display = "block";
}
