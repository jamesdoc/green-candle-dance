jQuery.noConflict();

jQuery(document).ready(function($) {

  /*
   * Hack for WonderPlugin Lightbox Free Version 2.1
   * Ensures that image captions on the gallery page are pulled from the alt text on the thumbnail
   * Also known as try and make things as easy as possible for the content authors / editors...
   */
  var images = jQuery('.wplightbox');
  if (images.length) {
    var headings = document.querySelectorAll('.entry-content h1');
    var index = 0;
    var galleryRef = '';
    for (index=0; index < headings.length; index++) {
      headings[index].className = "gallery__heading";
      for (var t = 0; t < headings[index].nextElementSibling.children.length; t++) {
        headings[index].nextElementSibling.children[t]['dataset']['group'] = 'gallery_' + index;
        headings[index].nextElementSibling.children[t].className = 'wplightbox gallery_' + index;
      }
      var parentEl = headings[index].parentNode;
      var showButton = document.createElement("a");
      showButton.className = "gallery__showmore btn btn--point-right";
      showButton['dataset']['group'] = 'gallery_' + index;
      showButton.appendChild(document.createTextNode("Show all images..."));
      parentEl.insertBefore(showButton, headings[index].nextSibling);
    };

    var counter = 0;
    images.each(function (i, el) {

      if(el.children[0]['alt']) {
        el.title = el.children[0]['alt'];
      }

     /*
      * Limits thumbnails to one row (first 6 images) and then adds a show more link
      * Totally going to need rework if this site goes RWD. Let's cross that bridge later!
      */
      el = jQuery(el);
      var element_gallery = el.data('group');

      if (galleryRef !== element_gallery) {
        galleryRef = element_gallery;
        counter = 0;
      }

      if (counter > 5) {
        el.hide();
      } else {
        counter += 1;
      }
    });
  }

  /* Turn on the show more button */
  var btns = document.getElementsByClassName('gallery__showmore');
  for (index=0; index < btns.length; index++) {
    btns[index].addEventListener("click", function(e) {
      e.preventDefault();
      var gallery = e.target['dataset']['group'];
      var images = document.getElementsByClassName(gallery);
      var i = 0;
      for (i=0; i < images.length; i++) {
        images[i].style.display = "inline";
      }
    });
  }
});
