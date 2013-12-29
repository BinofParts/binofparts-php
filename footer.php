<div id="footer">
	<div class="container">
		<hr>
		<div class="footer col-sm-6 col-md-6 col-lg-6 col-sm-offset-3 col-lg-offset-3">
			<a href="http://blog.binofparts.com">Blog</a> &middot;
			<a target="_blank" href="https://facebook.com/binofparts">Facebook</a> &middot;
			<a target="_blank" href="https://twitter.com/binofparts">Twitter</a>
			<div class="pull-right">
				<a href="https://mixpanel.com/f/partner"><img src="//cdn.mxpnl.com/site_media/images/partner/badge_blue.png" alt="Mobile Analytics" /></a>
			</div>
			<p>&copy; <?php echo date('Y'); ?> Bin of Parts, Inc</p>
		</div>
	</div>
</div>

<script src="https://code.jquery.com/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap3-typeahead.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
  var duration = 500;           
  jQuery('.back-to-top').click(function(event) {
      event.preventDefault();
      jQuery('html, body').animate({scrollTop: 0}, duration);
      return false;
  })
  $('input.typeahead').typeahead({
    source: function (query, process) {
      $.ajax({
        url: 'search.php',
        type: 'GET',
        dataType: 'JSON',
        data: 'q=' + query,
        success: function(data) {
          process(data);
        }
      });
    }
  });
});
</script>