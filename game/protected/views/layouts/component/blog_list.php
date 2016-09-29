<?php foreach($blogs as $blog){ ?>
<div class="top_first_banner" style="text-align:left;">
	<div class="page_root_div" style="text-align:left;padding:15px;">
		<p>
			<a class="iprogram_title" href="/blog?blogid=<?php echo $blog['id']; ?>" style=""><?php echo $blog['title']; ?></a>
		</p>
		<p><?php echo $blog['summary']; ?></p>
		<div style="text-align:right;">
			<span>阅读(<?php echo $blog['read_count']; ?>)</span>
		</div>
	</div>
</div>
<?php } ?>