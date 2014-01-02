<div id="footer">
	<div class="container">
		<hr>
		<div class="footer col-sm-6 col-md-6 col-lg-6 col-xs-offset-3">
			<div class="col-xs-6 col-md-6">
				<a href="http://blog.binofparts.com">Blog</a> &middot;
				<a target="_blank" href="https://facebook.com/binofparts">Facebook</a> &middot;
				<a target="_blank" href="https://twitter.com/binofparts">Twitter</a>
				<p>&copy; <?php echo date('Y'); ?> Bin of Parts, Inc</p>
			</div>
			<div class="col-xs-6 col-md-6">
				<a href="https://mixpanel.com/f/partner"><img src="//cdn.mxpnl.com/site_media/images/partner/badge_blue.png" alt="Mobile Analytics" /></a>
			</div>
		</div>
	</div>
</div>

<script src="https://code.jquery.com/jquery.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/typeahead.min.js"></script>
<script src="http://twitter.github.com/hogan.js/builds/2.0.0/hogan-2.0.0.js"></script>

<script type="text/javascript">
$(document).ready(function() {
  var duration = 500;           
  jQuery('.back-to-top').click(function(event) {
      event.preventDefault();
      jQuery('html, body').animate({scrollTop: 0}, duration);
      return false;
  })
  $('.typeahead').typeahead({
    name: 'search',
    remote: '/search.php?q=%Query'
    minLength: 3, 
    limit: 10 
  });
});
</script>