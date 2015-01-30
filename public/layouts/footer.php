</div>

    <div id="footer">
      <div class="container">
      <br>
      <p style="text-align: center">
		<a href="http://alextenche.jolinar.org" style="text-align: center;text-decoration: none; color: black">alexTenche <?php echo date("Y", time()); ?></a>
		</p>
	</div>
  </body>
</html>
<?php if(isset($database)) { $database->close_connection(); } ?>