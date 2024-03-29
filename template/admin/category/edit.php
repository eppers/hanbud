{% extends 'layout.php' %}
{% block page_title %}edytuj kategorię{% endblock %}
{% block content %} 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading"><h1>{% if form=='edit' %}Edytuj{% else %}Dodaj{% endif %} kategorię</h1></div>


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
   <form name="site-form" action="{% if form=='edit' %}/admin/catalog/category/edit/{{category.cat_id}} {% else %} /admin/catalog/category/add {% endif %}" method="post" enctype="multipart/form-data">        
       
       
        <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
                <tr>
                    <th valign="top">Nazwa:</th>
                    <td><input type="text" name="name" class="inp-form" value="{{category.name}}"/></td>
                    <td></td>
                </tr>
                <tr>
                    <th valign="top">Pozycja:</th>
                    <td><input type="text" name="pos" class="inp-form" value="{{category.pos}}"/></td>
                    <td></td>
                </tr>	
                <tr>
                <tr>
                    <th valign="top">Obrazek:</th>
                    <td>
                        <img src="/public/img/{% if category.img is not empty %}categories/thumbs/{{ category.img }}{% else %}no_thumb.jpg{% endif %}" >
                        <input type="hidden" name="img" class="inp-form" value="{{category.img}}"/>
                    </td>
                    <td style="display: block"><a href="#" title="Pliki 2MB, jpeg, png, gif." id="upload-file-enable" class="btn btn-danger">Wybierz nowy obrazek</a></td>
                </tr>
                <tr id="upload-file">
                    <th valign="top">Wybierz obrazek:</th>
                    <td><input type="file" name="file" class="file_1" disabled="disabled"/></td>
                </tr>
                    <th>&nbsp;</th>
                    <td valign="top">
                            <button type="submit" class="btn btn-primary" >Zapisz</button>
                            <input type="reset" value="" class="form-reset"  />
                    </td>
                    <td></td>
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