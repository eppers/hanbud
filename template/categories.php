<article>
	<h1 class="content-header">Kategorie produktów</h1>

	<div class="content-box">
		<ul class="products-categories">
		<?php for($i=1; $i<6; ++$i): ?>
			<li>
				<span class="no">0<?php echo $i ?></span>
				<a href=""><img src="http://placehold.it/140x100" alt=""> <strong>Nazwa #<?php echo $i ?></strong></a>
			</li>
		<?php endfor ?>
		</ul>
	</div>
</article>