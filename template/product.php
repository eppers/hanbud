{% extends 'layout.php' %}

{% block page_title %}{{ title }}{% endblock %}
{% block content %}
<article>
	<h1 class="content-header">Kategorie produktów / <a href="/katalog/category,{{category.id}},{{category.clearUrl}}">{{category.name}}</a> / <a href="/katalog/subcategory,{{producer.id}},{{producer.clearUrl}}">{{producer.name}}</a> / <a href="/katalog/product,{{product.id}},{{product.clearUrl}}">{{product.name}}</a></h1>

	<div class="content-box">
            <div class="product-top">
                <div class="product-image-container">
                    <img src="/public/img/{% if product.img is not empty %}products/{{ product.img }}{% else %}no_product.jpg{% endif %}" alt="{{product.name|cleanUrl}}">
                </div>
                <div class="product-info-container">
                    <div class="producent-logo">
                        <img src="/public/img/{% if producer.img is not empty %}producers/{{ producer.img }}{% else %}no_producer.jpg{% endif %}" alt="{{producer.name|cleanUrl}}" alt="">
                    </div>
                    <p class="product-title">Nazwa produktu:</p>
                    <h2 class="product-name">{{product.name}}</h2>
                </div>
            </div>
            <div class="product-bottom">
                <p class="product-title">Opis produktu:</p>
                <p class="product-desc">
                    {{product.desc|nl2br}}
                </p>
            </div>
	</div>
</article>
{% endblock %}