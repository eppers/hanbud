{% extends 'layout.php' %}

{% block page_title %}{{ title }}{% endblock %}
{% block content %}
<article>
	<h1 class="content-header">Kategorie produktów {% if category is not empty %}/ <a href="/hanbud/katalog/category,{{category.id}},{{category.clearUrl}}">{{category.name}}</a> {% endif %}{% if subcategory is not empty %}/ <a href="/hanbud/katalog/subcategory,{{subcategory.id}},{{subcategory.clearUrl}}">{{subcategory.name}}</a> {% endif %}{% if product is not empty %}/ <a href="/hanbud/katalog/product,{{product.id}},{{product.clearUrl}}">{{product.name}}</a> {% endif %}</h1>

	<div class="content-box">
		<ul class="products-categories">
                    {% for category in list %}
			<li>
				<span class="no">{% if loop.index <= 9 %}0{{loop.index}}{% else %}{{loop.index}}{% endif %}</span>
				<a href=""><img src="http://placehold.it/140x100" alt=""> <strong>{{category.name}}</strong></a>
			</li>
                        {% else %}
                        Brak produktów
                        {% endfor %}
		</ul>
	</div>
</article>
{% endblock %}