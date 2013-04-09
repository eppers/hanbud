{% extends 'layout.php' %}

{% block page_title %}{{ title }}{% endblock %}
{% block content %}
<article>
	<h1 class="content-header">Kategorie produktów</h1>

	<div class="content-box">
            <div class="product-top">
                <div class="product-image-container">
                    <img src="/public/img/product_img.jpg" alt="">
                </div>
                <div class="product-info-container">
                    <div class="producent-logo">
                        <img src="/public/img/product_producent.jpg" alt="">
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