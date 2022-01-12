$.fn.previewImage = function () {
  $(this).change(function (e) {
    var url = URL.createObjectURL(e.target.files[0]);
    $(this).parents(".vich-image").children("img").remove();
    $(this)
      .parents(".vich-image")
      .prepend('<img class="previewImage" src="' + url + '"/>');
  });
};

$("#article_imageFile").previewImage();
