<?php 
	if (isset($_GET['s'])) {
		$s=$_GET['s'];
	}else{
		$s='';
	}
?>
<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
	<label><input type="text" id="search" name="s" id="s" value="<?php echo $s; ?>" placeholder="คำที่ต้องการค้นหา"></label><button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
</form>