$('#lightbox').on('show.bs.modal', function (event) {
  var img = $(event.relatedTarget);
  var modal = $(this);
  $("#modal-title").html(img.data('title'));
  console.log(img.data('title'));
  $("#modal-image").attr('src', img.attr('src'));
});
