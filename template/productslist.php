{% extends 'layout.php' %}

{% block page_title %}{{ title }}{% endblock %}
{% block content %}
<article>
	<h1 class="content-header">Kategorie produktów</h1>

	<div class="content-box">
		<ul class="products-categories">
                    {% for category in list %}
			<li>
				<span class="no">0{{loop.index}}</span>
				<a href=""><img src="http://placehold.it/140x100" alt=""> <strong>{{category.name}}</strong></a>
			</li>
                        {% endfor %}
		</ul>
	</div>
</article>
{% endblock %}