<?php

	/*
		This is the template for the footer

		@package sunsettheme
	*/

?>

<footer class="site-footer">

	<div class="container">
		<div class="row">
			<div class="col-sm-6 text-xs-center text-sm-left">
				<p>&#169; 2018 - All Rights Reserved.</p>
			</div>
			<div class="col-sm-6 text-xs-center text-sm-right">
				<p>Designed &amp; Developed by <a href="#">Webninjaz</a></p>
			</div>
		</div>
	</div>
</footer><!-- .site-footer -->
</div><!-- .page-box -->

<?php echo wp_footer();?>
<script type="text/javascript">
var txt="";

		function loadcrypto(){
			//alert('sss')
			var xhr=new XMLHttpRequest();
			xhr.open('GET','https://api.coinmarketcap.com/v1/ticker/?limit=50',true);
			xhr.onload=function(){
				if(this.status==200){
					var data=JSON.parse(this.responseText);
					//console.log(this.responseText);
					var output="<ul class='market_box'>";
					for(var i in data){
						if(parseFloat(data[i].percent_change_1h)>=0){
							var span='<span style="color:#19daa2; line-height:2;"><i class="fa fa-arrow-up" style="position:relative; top:3px;"></i></span>';
						}else{
							 span='<span style="color:red; line-height:2;"><i class="fa fa-arrow-down" style=" position:relative; top:3px;"></i></span>';
						}
						output+=
						'<div class="new"><img src="<?php echo get_template_directory_uri();?>/assets/img/icon.png"><li>'+data[i].symbol+'<br> '+data[i].price_usd+' ' +span+'</li> </div>';
					}
					output+="</ul>";
					document.getElementById('markqq').innerHTML=output;
				}
			}
			xhr.send();
		}
</script>
</body>
</html>
