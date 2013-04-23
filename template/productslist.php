{% extends 'layout.php' %}

{% block page_title %}{{ title }}{% endblock %}
{% block content %}
<article>
	<h1 class="content-header">Kategorie produktów {% if category is not empty %}/ <a href="/katalog/category,{{category.id}},{{category.clearUrl}}">{{category.name}}</a> {% endif %}{% if producer is not empty %}/ <a href="/katalog/subcategory,{{producer.id}},{{producer.clearUrl}}">{{producer.name}}</a> {% endif %}{% if product is not empty %}/ <a href="/katalog/product,{{product.id}},{{product.clearUrl}}">{{product.name}}</a> {% endif %}</h1>

	<div class="content-box">
		<ul class="products-categories">
                    {% for category in list %}
			<li>
				<span class="no">{% if loop.index <= 9 %}0{{loop.index}}{% else %}{{loop.index}}{% endif %}</span>
				<a href="/katalog/{{link}},{% if category.prod_id %}{{category.prod_id}}{% elseif category.subcat_id  %}{{category.subcat_id}}{% elseif category.id  %}{{category.id}}{% endif %},{{category.name|cleanUrl}}">
                                    <div class="img-container">
                                        <img src="{% if workspace is not empty and category.img is not empty%}{{workspace}}/thumbs/{{category.img}}{% else %}/public/img/no_thumb.jpg{% endif %}" alt="{{category.name|cleanUrl}}">
                                    </div>
                                    <strong>{{category.name}}</strong>
                                </a>
			</li>
                        {% else %}
                        Brak produktów
                        {% endfor %}
		</ul>
	</div>
</article>

{% endblock %}