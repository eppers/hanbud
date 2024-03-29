{% extends 'layout.php' %}
{% block page_title %}edytuj produkt{% endblock %}
{% block content %} 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading"><h1>{% if form=='edit' %}Edytuj{% else %}Dodaj{% endif %} produkt</h1></div>


<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
<tr>
	<th rowspan="3" class="sized"><img src="/public/admin/img/shared/side_shadowleft.jpg" width="20" height="300" alt="" /></th>
	<th class="topleft"></th>
	<td id="tbl-border-top">&nbsp;</td>
	<th class="topright"></th>
	<th rowspan="3" class="sized"><img src="./public/admin/img/shared/side_shadowright.jpg" width="20" height="300" alt="" /></th>
</tr>
<tr>
	<td id="tbl-border-left"></td>
	<td>
	<!--  start content-table-inner -->
	<div id="content-table-inner">
	
	<table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
	<td>
        {% if error is defined %}
            {% include 'error.php' %}
        {% endif %}
		<!-- start id-form -->
   <form name="site-form" action="{% if form=='edit' %}/admin/catalog/product/edit/{{product.prod_id}} {% else %} /admin/catalog/product/add {% endif %}" method="post" enctype="multipart/form-data">        
       
       
        <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
            <tr>
            <td>
                <table>
                <tr>
                    <th valign="top">Producent:</th>
                    <td>
                        <div class="control-group">
                            <select id="selectError" data-rel="chosen" name="producer_id">
                                    {% for producer in producers %}
                                    <option value="{{ producer.subcat_id }}" {% if producer.subcat_id==product.subcat_id %} selected {% endif %} >{{ producer.name }}</option>
                                    {% endfor %}
                            </select>
                        </div>
                    </td>
                </tr>	
                <tr>
                    <th valign="top">Nazwa:</th>
                    <td><input type="text" name="name" class="inp-form" value="{{product.name}}"/></td>
                    <td></td>
                </tr>
                <tr>
                    <th valign="top">Pozycja:</th>
                    <td><input type="text" name="pos" class="inp-form" value="{{product.pos}}"/></td>
                    <td></td>
                </tr>
                 <tr>
                    <th valign="top">Obrazek:</th>
                    <td><img src="/public/img/{% if product.img is not empty %}products/thumbs/{{ product.img }}{% else %}no_thumb.jpg{% endif %}" >
                        <input type="hidden" name="img" class="inp-form" value="{{product.img}}"/></td>
                </tr>
                <tr>
                    <th valign="top"></th>
                    <td style="display: block"><a href="#" title="Pliki 2MB, jpeg, png, gif." id="upload-file-enable" class="btn btn-danger">Zmień obrazek</a></td>
                </tr>
                <tr id="upload-file">
                    <th valign="top">Wybierz obrazek:</th>
                    <td><input type="file" name="file" class="file_1" disabled="disabled"/></td>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <td style="padding-top: 40px;">
                            <button type="submit" class="btn btn-primary" >Zapisz zmiany</button>
                            <input type="reset" value="" class="form-reset"  />
                    </td>
                    <td></td>
                </tr>
                </table>
            </td>
            <td style="vertical-align: top; padding-left: 100px;">
                <p class="title">Opis produktu:</p>
                <div class="control-group">
                        <div class="controls">
                            <textarea class="cleditor" id="textarea2" name="desc" rows="3">{{product.desc}}</textarea>
                        </div>
                </div>
            </td>
            </tr>
	</table>
	<!-- end id-form  -->

    </form>
	</td>
	<td>

</td>
</tr>
<tr>
<td><img src="/public/admin/img/shared/blank.gif" width="695" height="1" alt="blank" /></td>
<td></td>
</tr>
</table>
 
<div class="clear"></div>
 

</div>
<!--  end content-table-inner  -->
</td>
<td id="tbl-border-right"></td>
</tr>
<tr>
	<th class="sized bottomleft"></th>
	<td id="tbl-border-bottom">&nbsp;</td>
	<th class="sized bottomright"></th>
</tr>
</table>


<div class="clear">&nbsp;</div>

</div>
<!--  end content -->
<div class="clear">&nbsp;</div>
</div>
<!--  end content-outer -->
{% endblock %}