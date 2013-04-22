{% extends 'layout.php' %}

{% block page_title %}Galeria{% endblock %}
{% block content %}
<article>
	<h1 class="content-header">Galeria</h1>

	<div class="content-box">
		<ul class="gallery-list">
                   {% for foto in fotos %}
			<li>
                            <div class="gallery-col-left">
				<span class="no">{% if loop.index <= 9 %}0{{loop.index}}{% else %}{{loop.index}}{% endif %}</span>
                                <div class="img-container">
                                    <a href="/public/img/{% if foto.img is not empty %}gallery/{{ foto.img }}{% else %}no_foto.jpg{% endif %}" rel="lightbox[gallery]" title="{{foto.alt}}">
                                        <img src="/public/img/{% if foto.img is not empty %}gallery/thumbs/{{ foto.img }}{% else %}no_thumb.jpg{% endif %}" alt="{{foto.alt}}">
                                    </a>
                                </div>
                            </div>
                            <div class="gallery-col-right">
                                <p>Realizacja:</p>
                                <div>
                                    {{foto.desc}} 
                                </div>
                            </div>
			</li>
                    {% else %}
                        <li>Brak pozycji</li>
                    {% endfor %}
		</ul>
	</div>
</article>

{% endblock %}