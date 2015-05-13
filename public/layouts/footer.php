
	<footer class="footer">
   		<div class="container">
        	<p class="muted credit"><a href="http://alextenche.jolinar.org" style="text-align: center;text-decoration: none; color: black">alexTenche <?php echo date("Y", time()); ?></a>   </p>
    	</div>
	</footer>

    <!-- Latest compiled and minified JavaScript for Bootstrap -->
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

</body>
</html>
<?php if(isset($database)) { $database->close_connection(); } ?>