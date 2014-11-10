    </div>
    <div id="footer">alexTenche <?php echo date("Y", time()); ?></div>
  </body>
</html>
<?php if(isset($database)) { $database->close_connection(); } ?>