  	<footer class="footer">
      <div class="container">
        <p class="text-muted"><a href="http://alextenche.jolinar.org" style="text-align: center;text-decoration: none; color: black">alexTenche <?php echo date("Y", time()); ?></a></p>
      </div>
    </footer>

</body>
</html>
<?php if(isset($database)) { $database->close_connection(); } ?>