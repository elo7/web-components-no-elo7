var proto = Object.create(HTMLElement.prototype);

proto.attachedCallback = function() {
	var root            = this.createShadowRoot(),
	    style           = document.createElement('style'),
	    imgContainer    = document.createElement('div'),
	    nextButton      = document.createElement('button'),
	    prevButton      = document.createElement('button'),
	    imgs            = this.querySelectorAll('img'),
	    shadowImgs      = [],
	    imgCount        = imgs.length,
	    componentWidth  = 0,
	    componentHeight = 0,
	    currentImage    = 0;

	style.innerHTML = '@import url(img-slider.css);';
	imgContainer.id = 'container';
	root.appendChild(style);
	root.appendChild(imgContainer);
	root.appendChild(prevButton);
	root.appendChild(nextButton);

	for (var i = 0; i < imgCount; i++) {
		var img       = imgs[i],
		    shadowImg = img.cloneNode(true);

		img.addEventListener('load', function() {
			componentWidth = Math.max(this.width, componentWidth);
			componentHeight = Math.max(this.height, componentHeight);
			imgContainer.style.width = componentWidth + 'px';
			imgContainer.style.height = componentHeight + 'px';
		});

		shadowImgs.push(shadowImg);
		imgContainer.appendChild(shadowImg);
	}

	function scrollToCurrentImage() {
		imgContainer.scrollLeft = shadowImgs[currentImage].offsetLeft;
	}

	nextButton.addEventListener('click', function() {
		currentImage++;
		if (currentImage === imgCount) {
			currentImage = 0;
		}
		scrollToCurrentImage();
	});

	prevButton.addEventListener('click', function() {
		currentImage--;
		if (currentImage < 0) {
			currentImage = imgCount - 1;
		}
		scrollToCurrentImage();
	});
};

document.registerElement('img-slider', { prototype: proto });
