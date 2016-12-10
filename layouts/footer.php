
</div>
<center><div class="footer container">
Under construction. <i>This was made to practice my web design & development skills</i>
</div></center>
<script>
  $(document).ready(function(){
    $("#btn-reload").click(function(){
      $(this).text("Reloading. . .");
    });

    $("#btn-search").click(function(){
      $(this).text("Searching....");
    });
$("#btn-update").click(function(){
  confirm("Are you sure?");
});

$("#logout").click(function(){
  $("#logoutmodal").modal();
});

  });
</script>
</body>
</html>