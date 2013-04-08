{% extends 'layout.php' %}

{% block page_title %}{{ title }}{% endblock %}
{% block content %}
<article>
	<h1 class="content-header">Kategorie produktów</h1>

	<div class="content-box">
            <div class="product-top">
                <div class="product-image-container">
                    <img src="/hanbud/public/img/product_img.jpg" alt="">
                </div>
                <div class="product-info-container">
                    <div class="producent-logo">
                        <img src="/hanbud/public/img/product_producent.jpg" alt="">
                    </div>
                    <p class="product-title">Nazwa produktu:</p>
                    <h2 class="product-name">Pustak 44 P+W</h2>
                </div>
            </div>
            <div class="product-bottom">
                <p class="product-title">Opis produktu:</p>
                <p class="product-desc">
                    Pustak ścienny przeznaczony do budowy zewnętrznych, jednowarstwowych ścian niewymagających docieplenia.<br >
                    Zewnętrzna ściana nośna bez docieplenia o współczynniku przenikania ciepła U=0,30 W/m2K. Grubość ściany wynosi 44 cm.
                </p>
            </div>
	</div>
</article>
{% endblock %}