function update() {
  $.get("index.php", function(data) {
    $("#some_div").html(data);
    window.setTimeout(update, 10000);
  });
}