$(document).ready(function () {
  $(".delete_button").click(function () {
    if (confirm("Czy napewno chcesz skasować?")) {
      var deleteId = $(this).data("id");
      var deleteName = $(".site_listing_table").data("name");
      $(this).attr(
        "href",
        "?page=" + deleteName + "-delete&id=" + deleteId + ""
      );
    } else {
      return false;
    }
  });

  $(".visible_blog").click(function () {
    var cb = $(this);
    var id = $(this).data("id");
    if (cb.is(":checked")) {
      check = 1;
      send_visible_post(check, id);
    } else {
      check = 0;
      send_visible_post(check, id);
    }
  });
});

function send_visible_post(check, id) {
  $.ajax({
    url: "ajax_index.php",
    data: { name: check, action: "blog_visible", id: id },
    type: "POST",
    cache: false,
  });
}
