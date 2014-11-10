</div>
    <div id="footer">Copyright <?php echo date("Y", time()); ?>, LexuCuFlexu :)</div>
  </body>
</html>
<?php if(isset($database)) { $database->close_connection(); } ?>