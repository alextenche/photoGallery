</div>
    <div id="footer">
		<a href="http://alextenche.jolinar.org" style="text-decoration: none; color: white">alexTenche <?php echo date("Y", time()); ?></a>
	</div>
  </body>
</html>
<?php if(isset($database)) { $database->close_connection(); } ?>